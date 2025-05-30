<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class JiraIntegrationController extends Controller
{

    public function getUserAssingedTaskListing(){
        $base_url = env('JIRA_API_BASE_URL');
        $api_key = env('JIRA_API_TOKEN');
        $auth_email = env('JIRA_ADMIN_ACCOUNT_EMAIL');
        $api_url = $base_url . "/rest/api/2/search";
        // To get login user jira assigned task
        $login_email = Auth::user()->email;
        $jql = 'assignee = "'.$login_email.'" ORDER BY project DESC, priority DESC';
        // To get required fields
        $required_fields = 'project,summary,key,status,priority,id';
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode("$auth_email:$api_key"),
            'Accept' => 'application/json',
            ])->get($api_url, [
                'jql' => $jql,
                'fields' => $required_fields,
            ]);

        if ($response->successful()) {
            $data = $response->json();
            $tasks = collect($data['issues'])->map(function ($issue) {
                return [
                    'project_name' => $issue['fields']['project']['name'],
                    'task_summary' => $issue['fields']['summary'],
                    'task_key' => $issue['key'],
                    'task_status' => $issue['fields']['status']['name'],
                    'task_priority' => $issue['fields']['priority']['name'] ?? 'None',
                    'task_id' => $issue['id']
                ];
            });
            return $tasks;
        } else {
            return response()->json([
                'error' => 'Jira request failed',
                'jira_error' => $response->json()
            ], $response->status());
        }
    }

    public function getUserTaskListing(){
        $tasks = json_decode($this->getUserAssingedTaskListing(), true);
        return view('dashboard', compact('tasks'));
    }
    
    
    public function updateTask(Request $request){
        try {
            // To get original task status
            $orignal_task_status = $request->orignal_task_status;
            // To get new task status
            $new_task_status = $request->status;
            // To get task key
            $task_key = $request->taskKey;
            // To get task summary
            $task_summary = $request->summary;

            $base_url = env('JIRA_API_BASE_URL');
            $api_key = env('JIRA_API_TOKEN');
            $auth_email = env('JIRA_ADMIN_ACCOUNT_EMAIL');

            // To get headers
            $headers = [
                'Authorization' => 'Basic ' . base64_encode("$auth_email:$api_key"),
                'Accept' => 'application/json',
            ];
            $final_api_url = $base_url . "/rest/api/3/issue/" . $task_key;

            $is_status_changed = false;
            if($orignal_task_status != $new_task_status){
                $status_change_status = $this->changeJiraIssueStatus($task_key, $new_task_status,$headers);
                if($status_change_status){
                    $is_status_changed = true;
                } else{
                    return response()->json(['success' => false, 'error' => 'Status update failed']);
                }
            }else{
                $is_status_changed = true;
            }
            // To update task summary
            if($is_status_changed){
                $response =  Http::withHeaders($headers)->put($final_api_url, [
                    'fields' => [
                        'summary' => $task_summary,
                    ]
                ]);
            if ($response->successful()) {
                return response()->json(['success' => true]);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => 'Jira API request failed',
                    'details' => $response->json()
                ], $response->status());
            }
        }else{
            return response()->json([
                'success' => false,
                'error' => 'Status not changed',
            ]);
        }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function openEditTicketDetailModal(Request $request){
        return view('components.edit_ticket_detail_modal');
    }


    function changeJiraIssueStatus($issueKey, $newStatusName,$headers){
        // To get base api url
        $base_api_url = env('JIRA_API_BASE_URL');
        // To get api key
        $api_key = env('JIRA_API_TOKEN');
        // To get final api url
        $final_api_url = $base_api_url . "/rest/api/3/issue/" . $issueKey;

        $response =  Http::withHeaders($headers)
            ->get("$final_api_url/transitions");

        if (!$response->successful()) {
            return ['success' => false, 'message' => 'Failed to fetch transitions'];
        }

        $transitions = $response->json('transitions');

        $transitionId = null;
        foreach ($transitions as $transition) {
            if (strtolower($transition['name']) === strtolower($newStatusName)) {
                $transitionId = $transition['id'];
                break;
            }
        }

        if (!$transitionId) {
            return ['success' => false, 'message' => 'Transition not found'];
        }

        $transitionResponse = Http::withHeaders($headers)
            ->post("$final_api_url/transitions", [
                'transition' => ['id' => $transitionId],
            ]);

        if ($transitionResponse->successful()) {
                return true;
            } else{
                return false;
            }
        }

    }
