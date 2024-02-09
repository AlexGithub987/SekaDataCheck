<?php

namespace AlexGithub987\sekadatacheck\Support;

use AlexGithub987\sekadatacheck\Models\JiraTask as ModelsJiratask;
use Illuminate\Support\Facades\Http;

class jiraTask
{

    public static function createIssue($data)
    {

        $jira_exists = ModelsJiraTask::where('table_name', $data['table'])->where('table_row_id', $data['table_row'])->first();
        if (isset($jira_exists)) {
            return '';
        }

        $data['username'] = config('app.jirauser');
        $data['password'] = config('app.jirapassword');
        $data['content'] = 'application/json';
        $data['endpoint'] = config('app.jiraurl');

        $dummy['project']['key'] = config('app.jiraproject');
        $dummy['summary'] = config('app.env') . ' :: ' . $data['summary'];
        $dummy['description'] =  $data['description'];
        $dummy['issuetype']['name'] = 'Bug';
        $dummy['assignee']['id'] = config('app.jiraassignee');

        $json['fields'] = $dummy;

        $res = Http::withHeaders(['X-Atlassian-Token' => 'no-check', 'User-Agent' => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)'])
            ->withBasicAuth($data['username'], $data['password'])
            ->withOptions(['verify' => false])
            ->accept($data['content'])
            ->contentType($data['content'])
            ->withBody(json_encode($json), $data['content'])
            ->post($data['endpoint'])
            ->json();

        $Jiramodel = new ModelsJiraTask;

        $Jiramodel->table_name = $data['table'];
        $Jiramodel->table_row_id = $data['table_row'];
        $Jiramodel->description = $res['key'] . ' | ' . $data['description'];
        $Jiramodel->save();
    }
}
