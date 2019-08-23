<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function Index()
    {
        $projects = \App\Project::all();

        return view('projects.index')->with('projects', $projects);
    }

    public function Project($projectId)
    {
        $project = \App\Project::find($projectId);

        return view('projects.project')->with('project', $project);
    }

    public function Create(Request $request)
    {
        $project = new \App\Project;
        $project->name = $request->input('name');
        $project->latitude = 0;
        $project->longitude = 0;
        $project->save();

        return redirect('/projects');
    }

    public function Edit(Request $request, $projectId)
    {
        $project = \App\Project::find($projectId);

        // update values
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->legend = $request->input('legend');
        $project->latitude = $request->input('latitude');
        $project->longitude = $request->input('longitude');
        $project->save();

        return redirect('/projects');
    }
}
