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
	zoom: 6,
	layers: [streets]
});
    
const baseLayers = {
        "Streets": streets,
        "Dark": dark,
        "Satellite": satellite
    };

    const layerControl = L.control.layers(baseLayers, null, {collapsed:false}).addTo(map);


// DAFTAR 38 PROVINSI
const provinsiData = [
    {kode:'11', nama:'Aceh', gambar:'aceh.jpg', warna:'#FF0000'},
    {kode:'12', nama:'Sumatera Utara', gambar:'sumut.jpg', warna:'#00FF00'},
    {kode:'13', nama:'Sumatera Barat', gambar:'sumbar.jpg', warna:'#0000FF'},
    {kode:'14', nama:'Riau', gambar:'riau.jpg', warna:'#FFFF00'},
    {kode:'15', nama:'Jambi', gambar:'jambi.jpg', warna:'#FF00FF'},
    {kode:'16', nama:'Sumatera Selatan', gambar:'sumsel.jpg', warna:'#00FFFF'},
    {kode:'17', nama:'Bengkulu', gambar:'bengkulu.jpg', warna:'#800000'},
    {kode:'18', nama:'Lampung', gambar:'lampung.jpg', warna:'#008000'},
    {kode:'19', nama:'Kepulauan Bangka Belitung', gambar:'babel.jpg', warna:'#000080'},
    {kode:'21', nama:'Kepulauan Riau', gambar:'kepri.jpg', warna:'#FFA500'},
    {kode:'31', nama:'DKI Jakarta', gambar:'jakarta.jpg', warna:'#A52A2A'},
    {kode:'32', nama:'Jawa Barat', gambar:'jabar.jpg', warna:'#8A2BE2'},
    {kode:'33', nama:'Jawa Tengah', gambar:'jateng.jpg', warna:'#5F9EA0'},
    {kode:'34', nama:'DI Yogyakarta', gambar:'jogja.jpg', warna:'#D2691E'},
    {kode:'35', nama:'Jawa Timur', gambar:'jatim.jpg', warna:'#DC143C'}, 
    {kode:'36', nama:'Banten', gambar:'banten.jpg', warna:'#006400'}, 
    {kode:'51', nama:'Bali', gambar:'bali.jpg', warna:'#8B0000'}, 
    {kode:'52', nama:'Nusa Tenggara Barat', gambar:'ntb.jpg', warna:'#483D8B'}, 
    {kode:'53', nama:'Nusa Tenggara Timur', gambar:'ntt.jpg', warna:'#2F4F4F'}, 
    {kode:'61', nama:'Kalimantan Barat', gambar:'kalbar.jpg', warna:'#FF1493'}, 
    {kode:'62', nama:'Kalimantan Tengah', gambar:'kalteng.jpg', warna:'#1E90FF'}, 
    {kode:'63', nama:'Kalimantan Selatan', gambar:'kalsel.jpg', warna:'#B22222'}, 
    {kode:'64', nama:'Kalimantan Timur', gambar:'kaltim.jpg', warna:'#228B22'}, 
    {kode:'65', nama:'Kalimantan Utara', gambar:'kaltara.jpg', warna:'#FFD700'},
    {kode:'71', nama:'Sulawesi Utara', gambar:'sulut.jpg', warna:'#4B0082'},
    {kode:'72', nama:'Sulawesi Tengah', gambar:'sulteng.jpg', warna:'#F08080'},
    {kode:'73', nama:'Sulawesi Selatan', gambar:'sulsel.jpg', warna:'#20B2AA'},
    {kode:'74', nama:'Sulawesi Tenggara', gambar:'sultra.jpg', warna:'#87CEFA'},
    {kode:'75', nama:'Gorontalo', gambar:'gorontalo.jpg', warna:'#778899'},
    {kode:'76', nama:'Sulawesi Barat', gambar:'sulbar.jpg', warna:'#32CD32'},
    {kode:'81', nama:'Maluku', gambar:'maluku.jpg', warna:'#800080'},
    {kode:'82', nama:'Maluku Utara', gambar:'malut.jpg', warna:'#FF4500'},
    {kode:'91', nama:'Papua', gambar:'papua.jpg', warna:'#2E8B57'},
    {kode:'92', nama:'Papua Barat', gambar:'papuabarat.jpg', warna:'#4682B4'},
    {kode:'93', nama:'Papua Selatan', gambar:'papuaselatan.jpg', warna:'#DA70D6'},
    {kode:'94', nama:'Papua Tengah', gambar:'papuatengah.jpg', warna:'#CD5C5C'},
    {kode:'95', nama:'Papua Pegunungan', gambar:'papuapegunungan.jpg', warna:'#556B2F'},
    {kode:'96', nama:'Papua Barat Daya', gambar:'papuabaratdaya.jpg', warna:'#9932CC'}
];

// LOOPING GEOJSON
provinsiData.forEach(function(item){

    $.getJSON("<?= base_url('provinsi/') ?>" + item.kode + ".geojson", function(data){

        L.geoJson(data,{
            style: function(feature){
                return{
                    color: item.warna,
                    fillColor: item.warna,
                    fillOpacity: 0.2,
                    weight: 2
                }
            }
        })

        .bindPopup(
            "<img src='<?= base_url('gambar/') ?>" + item.gambar + "' width='250px'><br>" +
            "<b>Provinsi " + item.nama + "</b><br>" +
            "Data wilayah provinsi " + item.nama
        )

        .addTo(map);

    });

});
</script>