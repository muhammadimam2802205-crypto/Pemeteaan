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

    // MARKER 1
    L.marker([-0.5058111112685578, 100.7787948063588], {icon: marker1})
    .bindPopup("<img src='<?=base_url('gambar/psdku.jpg')?>' width='250px'><br>" +
    "<b>Kampus PNP PSDKU TANAH DATAR</b><br>" +
    "Jalan Raya Setangkai - Tigo Jangko, Nagari Tigo Jangko, Kecamatan Lintau Buo, Kabupaten Tanah Datar, Sumatera Barat")
    .addTo(map);

    L.circle([-0.5058111112685578, 100.7787948063588], {
        radius: 100,
        color : 'blue',
        fillColor : 'red',
        fillOpacity : 0.3,
     })
     .bindPopup('PNP PSDKU TANAH DATAR')
     .addTo(map);
</script>