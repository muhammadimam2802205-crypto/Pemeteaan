<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Latitude</label>
            <input class="form-control" name="latitude" id="Latitude">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Longitude</label>
            <input class="form-control" name="longitude" id="Longitude">
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Posisi</label>
            <input class="form-control" name="posisi" id="Posisi">
        </div>
    </div>

    <div class="col-sm-12">
        <br>
        <div id="map" style="width: 100%; height: 100vh;"></div>
    </div>
</div>

<div id="map" style="width: 100%; height: 100vh;"></div>
<script>
    var streets = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap & CartoDB'
        });

    var dark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap & CartoDB'
        });

    var satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles © Esri'
    });


    const map = L.map('map', {
	center: [-0.5058111112685578, 100.7787948063588],
	zoom: 17,
	layers: [streets]
});
    
const baseLayers = {
        "Streets": streets,
        "Dark": dark,
        "Satellite": satellite
    };

    const layerControl = L.control.layers(baseLayers, null, {collapsed:false}).addTo(map);

var latinput = document.querySelector("[name=latitude]");
var lnginput = document.querySelector("[name=longitude]");
var posisi = document.querySelector("[name=posisi]");

var curLocation = [-0.5058111112685578, 100.7787948063588];

map.attributionControl.setPrefix(false);

var marker = new L.marker(curLocation, {
    draggable: true,
});

// mengambil titik koordinat pada saat marker dipindahkan
marker.on('dragend', function (e) {
    var position = marker.getLatLng();

    marker.setLatLng(position, {
        curLocation,
    }).bindPopup(position).update();

    $("#Latitude").val(position.lat);
    $("#Longitude").val(position.lng);
    $("#Posisi").val(position.lat + ',' + position.lng);
});

// mengambil titik koordinat pada saat map di klik
map.on('click', function(e){
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;

    if (!marker){
        marker = L.marker(e.latlng).addTo(map);
    } else {
        marker.setLatLng(e.latlng);
    }

    latinput.value = lat;
    lnginput.value = lng;
    posisi.value = lat + ',' + lng;
});

map.addLayer(marker);

</script>
</script>