var map,
    position,
    layer;
var files;
var isOpen;

const arrayToObject = (array) =>
   array.reduce((obj, item) => {
     obj[item[0]] = item[1]
     return obj
   }, {})

var colors = arrayToObject(legend);

function Edit(id) {
    var file = jQuery.grep(files, function( n, i ) {
        return ( n.id === id );
    })[0];

    if (file) {
        HidePhoto();
        $("#modalEdit").modal('show');
        $("#editId").val(id);
        $("#legend").val(file.legend);
        $("#legendvalue").val(file.legendvalue);
        $("#editDescription").val(file.description);
    }
}

function HidePhoto(e) {
    $("#photodiv").html('');
    $("#photodiv").hide();
    isOpen = false;
}

function DisplayPhoto(e) {
    var html = e.target.html;
    
    $("#photodiv").css({top: e.originalEvent.clientY, left: e.originalEvent.clientX + 10, position:'absolute'});
    $("#photodiv").html(html);
    $("#photodiv").show();
    isOpen = true;
}

function GetUploadsData() {
    layer.clearLayers();
    $.ajax({
        url : '/uploads/' + project.id + '/list',
        type : 'get',
        cache : false,
    }).done(function(data) {
        // present the data in the map
        files = data.files;

        for (var i = 0, l = data.files.length; i < l; i++) {
            var file = data.files[i];
            var html = '<p>' + file.description + '</p>';
            if (file.image) {
               html += '<a href="/pictures/' + file.image + '" target="_blank"><img src="/pictures/' + file.image + '" width="360"/></a>';
            }
            if (file.audio) {
                html += '<audio autoplay src="/audio/' + file.audio + '" controls></audio>';
            }
            if (file.video) {
            html += '<video autoplay src="/video/' + file.video + '" controls width="360"></video>';
            }
            html += '<p><a href="#" onclick="Edit(' + file.id + ')">Edit</a></p>';
            if (isAdmin) html += '<p><a href="/uploads/delete/' + file.id + '">Delete</a></p>';

            if (!file.legendvalue) file.legendvalue = 10;
            file.marker = L.circle([file.latitude, file.longitude], 25, {
                fillOpacity: 0.5 + (file.legendvalue / 20),
                opacity: 0,
                color: colors[file.legend] || '#555555'
            }).addTo(layer);

            file.marker.html = html;
            file.marker.on({ mouseover: DisplayPhoto });
        }
    });
}

$(function() {
    layer = L.layerGroup();
    map = L.map('map-canvas', {
        zoomControl: false,
        center: [project.latitude, project.longitude],
        minZoom: 1,
        maxZoom: 18,
        zoom: 16
    });
    L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner/{z}/{x}/{y}.png', {
        attribution: 'Map tiles by Stamen Design, under <a href="http://creativecommons.org/licenses/by/3.0/">CC BY 3.0</a>. ' + 
            'Data by OpenStreetMap, under <a href="http://opendatacommons.org/licenses/odbl/">ODbL</a>'
    }).addTo(map);
    
    layer.addTo(map);
    
    map.on('move', function(e) {
        HidePhoto();
    });
    map.on('click', function(e) {
        if (isOpen) {
            HidePhoto();
            return;
        }
        // reset the form
        $('#dataform').trigger("reset");

        position = e.latlng;
        var url = 'https://nominatim.openstreetmap.org/reverse?format=json&lat=' + position.lat + '&lon=' + position.lng + '&zoom=18&addressdetails=1';
        $.ajax({
            url : url,
            type : 'post',
            cache : false,
            dataType : 'json'
        }).done(function(data) {
            $("#labelaudio").html('');
            $('#labelvideo').html('');
            $('#labelpicture').html('');
            $("#streetname").text(data.address.road);
            $("#modalUpload").modal('show');
        });
    });

    $("input[name='audiofile']").change(function (evt) {
        $('#labelaudio').html('Audio set');
    });

    $("input[name='videofile']").change(function (evt) {
        $('#labelvideo').html('Video set');
    });
    
    $("input[name='picture']").change(function (evt) {
        $('#labelpicture').html('Image set');
    });
    $("form#editform").submit(function(event) {
        // evitamos el envio default
        event.preventDefault();
        // obtenemos los datos del formulario
        var formData = new FormData($(this)[0]);
        $.ajax({
            url : '/uploads/' + project.id + '/edit',
            type : 'post',
            data : formData,
            cache : false,
            contentType : false,
            processData : false
        }).fail(function(xhr, textStatus, errorThrown) {
            alert('Cant send the data right now.' + xhr.status + '\n' + errorThrown);
        }).done(function(data) {
            if (data.success == false) {
                // alert errors
                alert(data.message);
            };
        }).always(function(data) {
            $("#modalEdit").modal('hide');
            GetUploadsData();
        });
        return false;
    });
    $("form#dataform").submit(function(event) {
        // evitamos el envio default
        event.preventDefault();
        // obtenemos los datos del formulario
        var formData = new FormData($(this)[0]);
        // añadimos el resto de datos
        formData.append('lat', position.lat);
        formData.append('lng', position.lng);
        
        $('#modalUpload').modal('hide');
        $('#modalUploading').modal('show');
        
        $.ajax({
            url : '',
            type : 'post',
            data : formData,
            cache : false,
            contentType : false,
            processData : false
        }).fail(function(xhr, textStatus, errorThrown) {
            alert('Cant send the data right now.' + xhr.status + '\n' + errorThrown);
        }).done(function(data) {
            if (data.success == false) {
                // alert errors
                alert(data.message);
            };
        }).always(function(data) {
            $('#modalUploading').modal('hide');
            GetUploadsData();
        });
        return false;
    });
    GetUploadsData();
});
