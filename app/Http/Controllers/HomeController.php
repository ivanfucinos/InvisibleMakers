<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\Markdown\Facades\Markdown;

class HomeController extends Controller
{
    public function Index(Request $request, $projectId = NULL)
    {
        $projects = \App\Project::all();
        $description = NULL;

        if (!$projectId) {
            $projectId = $request->session()->get('projectId');
        }
        $projectId = $projectId ?? config('app.project');
        $request->session()->put('projectId', $projectId);
        $project = \App\Project::find($projectId);

        if ($project) {
            $description = Markdown::convertToHtml($project->description);
        }

        return view('home.index')->with('description', $description)->with('projects', $projects);
    }
}
