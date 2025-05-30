<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Jira Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Jira settings. 
    |
    */

    'endpoint_url' => env('JIRA_END_POINT_URL', ''),
    'username' => env('JIRA_USERNAME', ''),
    'api_token' => env('JIRA_API_TOKEN', ''),
]; 