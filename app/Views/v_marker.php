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
        iconUrl: '<?=base_url('icon/i_kampus.png')?>',
        iconSize: [45, 45],
    })

    const marker2 = L.icon({
        iconUrl: '<?=base_url('icon/shop.png')?>',
        iconSize: [45, 45],
    })

    const marker3 = L.icon({
        iconUrl: '<?=base_url('icon/puskesmas.png')?>',
        iconSize: [45, 45],
    })

    const marker4 = L.icon({
        iconUrl: '<?=base_url('icon/store.png')?>',
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

    // MARKER 2
    L.marker([-0.5003124980674273, 100.7765060490625], {icon: marker2})
    .bindPopup("<img src='<?=base_url('gambar/berkah.jpg')?>' width='250px'><br>" +
    "<b>Berkah Mart 99</b><br>" +
    "Jl. Tigo Jangko Raya, Tigo Jangko, Kec. Lintau Buo, Kabupaten Tanah Datar, Sumatera Barat")
    .addTo(map);

    // MARKER 3
    L.marker([-0.5080332677437007, 100.77941745452907], {icon: marker3})
    .bindPopup("<img src='<?=base_url('gambar/puskesmas.jpg')?>' width='250px'><br>" +
    "<b>Puskesmas</b><br>" +
    "Jl. Raya Sitangkai - Balai Tangah KM 3, Nagari Tigo Jangko, Kec. Lintau Buo.")
    .addTo(map);

    // MARKER 4
    L.marker([-0.5133642819624703, 100.78025338700327], {icon: marker4})
    .bindPopup("<img src='<?=base_url('gambar/toko2.jpg')?>' width='250px'><br>" +
    "<b>Toko Versi</b><br>" +
    " Taluak, Kec. Lintau Buo, Kabupaten Tanah Datar, Sumatera Barat.")
    .addTo(map);

    // MARKER 5
    L.marker([-0.5036542574002065, 100.77823408638187], {icon: marker5})
    .bindPopup("<img src='<?=base_url('gambar/smkn1.jpg')?>' width='250px'><br>" +
    "<b>SMKN 1 Tanah Datar</b><br>" +
    "Taluak, Kec. Lintau Buo, Kabupaten Tanah Datar, Sumatera Barat.")
    .addTo(map);

</script>