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
<div class="jumbotron" id="about">
    <div class="container">
        {!! $description !!}
    </div>
</div>
@if ($projects->count() > 1)
<div class="container">
@foreach ($projects as $project)
    <a href="/{{ $project->id }}">{{ $project->name }}</a>
@endforeach
</div>
@endif
<div class="footer">
  <div class="container">
    <p class="text-muted">2018 Performative Mapping (c)</p>
  </div>
</div>
@stop