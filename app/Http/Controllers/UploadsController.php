<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadsController extends Controller
{
    function LoadProject(Request $request, $projectId = NULL) {
        if (!$projectId) {
            $projectId = $request->session()->get('projectId');
        }
        $projectId = $projectId ?? config('app.project');
        $project = \App\Project::find($projectId);

        return $project;
    }

    public function Index(Request $request, $projectId = NULL)
    {
        $project = $this->LoadProject($request, $projectId);
        $legend = explode("\n", $project->legend);
        foreach($legend as &$line) {
            $line = explode(",", $line);
        }

        return view('uploads.index')->with('project', $project)->with('legend', $legend);
    }

    public function List(Request $request, $projectId = NULL) {
        $project = $this->LoadProject($request, $projectId);

        $files = \App\File::where('upload', '1')->inProject($project->id)->get();

        // return json
        return response()->json(array('files' => $files));
    }

    public function Edit(Request $request, $projectId = NULL) {
        $id = $request->input('id');

        $element = \App\File::find($id);
        $element->legend = $request->input('legend');
        $element->legendvalue = $request->input('legendvalue');
        $element->description = $request->input('editDescription');
        $element->save();

        return response()->json(array('success' => true, 'message' => NULL));
    }

    public function Delete(Request $request, $fileId) {

        $element = \App\File::find($fileId);
        $element->delete();

        return redirect('/uploads');
    }

    public function Post(Request $request, $projectId = NULL) {
        $project = $this->LoadProject($request, $projectId);

        $success = false;
        $message = "";
        $audiofilename = NULL;
        $videofilename = NULL;
        $picfilename = NULL;

        // files can be big; check we have the data
        if ($request->hasFile('audiofile')) {
            $audiofile = $request->file('audiofile');
            $destinationPath = public_path() . '/audio';
            $audiofilename = str_random(12) . "." . $audiofile->getClientOriginalExtension();
            $success = $audiofile->move($destinationPath, $audiofilename);
        }
        
        if ($request->hasFile('videofile')) {
            $videofile = $request->file('videofile');
            $destinationPath = public_path() . '/video';
            $videofilename = str_random(12) . "." . $videofile->getClientOriginalExtension();
            $success = $videofile->move($destinationPath, $videofilename);
        }
        
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $destinationPath = public_path() . '/pictures';
            $picfilename = str_random(12) . "." . $image->getClientOriginalExtension();
            $success = $image -> move($destinationPath, $picfilename);
        }
        
        if ($success) {
            // save to database
            $file = new \App\File;
            $file->userid = Auth::id();
            $file->description = $request->input('textdesc');
            $file->audio = $audiofilename;
            $file->video = $videofilename;
            $file->image = $picfilename;
            $file->latitude = $request->input('lat');
            $file->longitude = $request->input('lng');
            $file->upload = 1;
            $file->project = $project->id;
            $file->save();
        } else {
            $message = "File can't be uploaded";
        }

        // devolvemos la respuesta como JSON
        return response()->json(array('success' => $success, 'message' => $message));
    }
}
