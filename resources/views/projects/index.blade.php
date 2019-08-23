@extends('layout')
@section('content')
@if (isset($myMessage))
<br />
<br />
<div class="container">
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        {{{ $myMessage }}}
    </div>
</div>
@endif
<br />

<div class="container">
    <h1>Projects</h1>
@if ($projects->count())
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Created</th>
            </tr>
        </thead>
        
        <tbody>
        @foreach ($projects as $project)
            <tr>
                <td><a href="/projects/{{ $project->id }}">{{ $project->name }}</a></td>
                <td>{{ $project->latitude }}</td>
                <td>{{ $project->longitude }}</td>
                <td>{{ $project->created_at }}</td>
            </tr>
        @endforeach
          
        </tbody>
    </table>

    <hr />
    <h2>Create new project</h2>
    <form method="POST" action="/projects/create">
    @csrf
        <div class="form-group">
            <label for="name">Project name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter a name">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create project</button>
        </div>
    </form>
@else
    <p>There are no projects</p>
@endif
</div>

<div class="footer">
  <div class="container">
    <p class="text-muted">2018 Performative Mapping (c)</p>
  </div>
</div>
@stop