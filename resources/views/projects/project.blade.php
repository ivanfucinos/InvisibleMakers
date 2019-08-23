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
    <div class="row">
        <div class="col-md-10">
            <form method="POST" action="">
                @csrf
                <div class="form-group">
                    <label for="name">Project name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter a name" value="{{ $project->name }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="12">{{ $project->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="legend">Legend</label>
                    <textarea name="legend" class="form-control" rows="12">{{ $project->legend }}</textarea>
                </div>
                <div class="form-group">
                    <label for="latitude">latitude</label>
                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Enter a latitude" value="{{ $project->latitude }}">
                </div>
                <div class="form-group">
                    <label for="longitude">longitude</label>
                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Enter a longitude" value="{{ $project->longitude }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="footer">
  <div class="container">
    <p class="text-muted">2018 Performative Mapping (c)</p>
  </div>
</div>
@stop