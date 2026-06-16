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

 const markerIcon = L.icon({
        iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
        shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41]
    });

    const marker1 = L.icon({
        iconUrl: '<?=base_url("icon/i_kampus.png")?>',
        iconSize: [45, 45],
    })
     const marker5 = L.icon({
        iconUrl: '<?=base_url('icon/school.png')?>',
        iconSize: [45, 45],
    })

    // MARKER 1
    L.marker([-0.5058111112685578, 100.7787948063588], {icon: marker1})
    .bindPopup("<img src='<?=base_url('gambar/psdku.jpg')?>' width='250px'><br>" +
    "<b>Kampus PNP PSDKU TANAH DATAR</b><br>" +
    "Jalan Raya Setangkai - Tigo Jangko, Nagari Tigo Jangko, Kecamatan Lintau Buo, Kabupaten Tanah Datar, Sumatera Barat")
    .addTo(map);
     // MARKER 5
    L.marker([-0.5036542574002065, 100.77823408638187], {icon: marker5})
    .bindPopup("<img src='<?=base_url('gambar/smkn1.jpg')?>' width='250px'><br>" +
    "<b>SMKN 1 Tanah Datar</b><br>" +
    "Taluak, Kec. Lintau Buo, Kabupaten Tanah Datar, Sumatera Barat.")
    .addTo(map);



    //polyline
    L.polyline([
        [-0.5056603285250737, 100.77851787554395],
        [-0.5055771832848178, 100.77897250994931],
        [-0.5060009557885297, 100.77901676639584],
        [-0.5060250947277717, 100.77861309395922],
        [-0.5056603285250737, 100.77851787554395]
    ], {
        color: 'red',
        weight: 5,
    })
    .bindPopup("<img src='<?= base_url('gambar/psdku.jpg') ?>' width='250px'> <br>"+
    "<b>Kampus PNP PSDKU TANAH DATAR</b> <br>"+
    "Panjang : 2 Km <br>"+
    "Lebar : 6 Meter <br>")
    .addTo(map)
</script>