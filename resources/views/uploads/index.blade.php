@extends('layout')
@section('extracss')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />
        <style type="text/css">
            html {
                height: 100%
            }
            body {
                height: 100%;
                margin: 0;
                padding: 0
            }
            #map-canvas {
                height: 100%
            }
        </style>
@stop
@section('extrajs')
        <script>
            project = @json($project);
            legend = @json($legend);
            isAdmin = null;
            @auth

            isAdmin = {{ Auth::user()->admin }}
            @endauth
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
        <script src="/js/uploads.js"></script>
@stop

@section('content')
<div id="map-canvas"></div>

<div class="makerstoolbox" id="photodiv" style="left: -900px;"></div>

<div class="modal fade" id="modalUploading">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <h4 class="modal-title">Uploading data</h4>
        </div>
    </div>
</div>
@auth
<div class="over-alert alert alert-info" id="uploadinfo">
    <p>Click on a location on the map to add a file</p>
</div>

<div class="modal fade" id="modalUpload">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" id="dataform" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add upload in the selected location</h4>
                    <p id="streetname"></p>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="textdesc">Enter a text</label>
                        <input type="text" class="form-control" name="textdesc" id="textdesc" placeholder="Enter a text">
                    </div>
                    <div class="btn btn-primary fileUpload">
                        <span>Add an audio file</span>
                        <input accept="audio/*" class="upload" name="audiofile" id="audiofile" type="file">
                    </div>
                    <label id="labelaudio"></label>
                        
                    <div class="btn btn-primary fileUpload">
                        <span>Add a video file</span>
                        <input accept="video/*" class="upload" name="videofile" id="videofile" type="file">
                    </div>
                    <label id="labelvideo"></label>
                        
                    <div class="btn btn-primary fileUpload">
                        <span>Add an image</span>
                        <input accept="image/*" class="upload" name="picture" id="picture" type="file">
                    </div>
                    <label id="labelpicture"></label>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Accept</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="/uploads/{{$project->id}}/edit" id="editform">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Set legend to element</h4>
                    <input type="hidden" name="id" id="editId">
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="legend">Select legend</label>
                        <select name="legend" id="legend" class="form-control">
                        @foreach ($legend as $line)
                            <option>{{ $line[0] }}</option>
                        @endforeach
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="legendvalue">Select value (informal-formal)</label>
                        <input type="range" name="legendvalue" id="legendvalue" min="1" max="10" step="1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editDescription">Enter a text</label>
                        <input type="text" class="form-control" name="editDescription" id="editDescription" placeholder="Enter a text">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Accept</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth
<div class="container legendtoolbox">
    <div style="background-color: #eeeeee">
        @foreach ($legend as $line)
            <span style="background-color: transparent; color: {{ $line[1] }}; text-align: left; border: none"><strong>{{ $line[0] }}</strong></span><br />
        @endforeach
    </div>
</div>
@stop