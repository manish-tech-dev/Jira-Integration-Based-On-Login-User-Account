<div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(count($tasks) > 0)
                        <div style="position: absolute; font-size: 20px; font-weight: bold; margin-left: 10px;">
                            <h1 class="text-2xl font-bold text-gray-800 text-center py-4 text-[20px]">Jira Task List: </h1>
                        </div>
                    @endif
                    
                    <div class="overflow-x-auto relative">
                        <table class="w-full" id="task-listing-table" style="font-size: 14px;">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left p-4 font-semibold text-gray-600" style="text-align: left;">TASK ID</th>
                                    <th class="text-left p-4 font-semibold text-gray-600" style="text-align: left;">PROJECT NAME</th>
                                    <th class="text-left p-4 font-semibold text-gray-600" style="text-align: left;">TASK SUMMARY</th>
                                    <th class="text-left p-4 font-semibold text-gray-600" style="text-align: left;">TASK KEY</th>
                                    <th class="text-left p-4 font-semibold text-gray-600" style="text-align: left;">STATUS</th>
                                    <th class="text-left p-4 font-semibold text-gray-600" style="text-align: left;">PRIORITY</th>
                                    <th class="text-left p-4 font-semibold text-gray-600" style="text-align: left;">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($tasks) > 0)
                                    @foreach ($tasks as $task)
                                    <tr class="border-b bg-white hover:bg-gray-50" data-task-key="{{ $task['task_key'] }}">
                                    <td class="p-2 text-gray-600" style="text-align: left !important;">{{ $task['task_id'] }}</td>
                                    <td class="p-2 text-gray-600">{{ $task['project_name'] }}</td>
                                    <td class="p-2 text-gray-600">{{ $task['task_summary'] }}</td>
                                    <td class="p-2 text-gray-600">{{ $task['task_key'] }}</td>
                                    <td class="p-2">
                                        <span class="px-3 py-1 text-sm bg-green-100 text-green-800 rounded-full">{{ $task['task_status'] }}</span>
                                    </td>
                                    <td class="p-2">
                                        <span class="px-3 py-1 text-sm bg-red-100 text-red-800 rounded-full">{{ $task['task_priority'] }}</span>
                                    </td>
                                    <td class="p-2">
                                        <button onclick="editTask('{{ $task['task_key'] }}')" class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" style="background: #909090; padding: 4px 12px;">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7" class="p-4 text-gray-600 text-center">No tasks are currently assigned to you</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 z-50 hidden" style="background: rgba(0, 0, 0, 0.4); overflow: hidden;">
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="relative bg-white rounded-lg shadow-xl w-1/2 mx-auto" style="width: 600px;">
            <div class="px-6 py-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900">Edit Task</h3>
            </div>

            <div class="px-6 py-4">
                <form id="editTaskForm">
                    <input type="hidden" id="editTaskKey" name="taskKey">

                    <div class="mb-4">
                        <label for="taskSummary" class="block text-sm font-medium text-gray-700 mb-2">Task Summary</label>
                        <input type="text" id="taskSummary" name="summary"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="taskStatus" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="taskStatus" name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="To Do">To Do</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="px-6 py-4 border-t bg-gray-50 flex justify-end space-x-3 rounded-b-lg">
                <button type="button" onclick="CloseModal()"
                    class="px-4 py-2 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300" style="margin-right: 10px;">
                    Cancel
                </button>

                <button type="button" onclick="saveTask()"
                    class="px-4 py-2 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var task_count = {{ count($tasks) }};
        console.log(task_count);
        if(task_count > 0){
            $('#task-listing-table').DataTable({
                "bInfo": false,        // Hides "Showing X to Y of Z entries"
                "lengthChange": false  // Hides "entries per page" dropdown
            });
        }
    });
    
function editTask(taskKey) {
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editTaskKey').value = taskKey;
    const row = document.querySelector(`tr[data-task-key="${taskKey}"]`);
    if (row) {
        const summary = row.querySelector('td:nth-child(3)').textContent;
        const status = row.querySelector('td:nth-child(5) span').textContent;
        document.getElementById('taskSummary').value = summary;
        document.getElementById('taskStatus').value = status;
        document.getElementById('orignal_task_status').value = status;
        document.getElementById('orignal_task_summary').value = summary;
    }
}

function CloseModal() {
    document.getElementById('editModal').classList.add('hidden');
}

function saveTask() {
    $("#new_spinner_loader_main").fadeIn();
    const taskKey = document.getElementById('editTaskKey').value;
    const summary = document.getElementById('taskSummary').value;
    const status = document.getElementById('taskStatus').value;
    const orignal_task_status = document.getElementById('orignal_task_status').value;
    const orignal_task_summary = document.getElementById('orignal_task_summary').value;
    if(orignal_task_summary == summary && orignal_task_status == status){
        alert('No changes made');
        $("#new_spinner_loader_main").fadeOut();
        return false;
    }
    $.ajax({
        url: '/update-task',
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            taskKey: taskKey,
            summary: summary,
            status: status,
            orignal_task_status: orignal_task_status,
            orignal_task_summary: orignal_task_summary
        },
        success: function(response) {
            console.log(response);
            if (response.success) {
                // Update the table row
                const row = $(`tr[data-task-key="${taskKey}"]`);
                if (row.length) {
                    row.find('td:nth-child(3)').text(summary);
                    row.find('td:nth-child(5) span').text(status);
                }
                CloseModal();
                $("#new_spinner_loader_main").fadeOut();
                // Show success notification
                if (typeof toastr !== 'undefined') {
                    toastr.success('Task updated successfully!');
                } else {
                    alert('Task updated successfully!');
                }
            } else {
                // Show error notification
                if (typeof toastr !== 'undefined') {
                    toastr.error(response.error || 'Failed to update task. Please try again.');
                } else {
                    alert(response.error || 'Failed to update task. Please try again.');
                }
                $("#new_spinner_loader_main").fadeOut();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            $("#new_spinner_loader_main").fadeOut();
            // Show error notification
            if (typeof toastr !== 'undefined') {
                toastr.error('An error occurred while updating the task.');
            } else {
                alert('An error occurred while updating the task.');
            }
        }
    });
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('editModal');
    if (event.target === modal) {
        CloseModal();
    }
}



</script>