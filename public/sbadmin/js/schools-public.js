// public/sbadmin/js/schools-public.js

var map;
var markers = [];
var allSchools = [];
var currentCenter = [-0.4464, 100.5872]; // Batusangkar

// Inisialisasi peta
function initMap() {
    map = L.map('schoolsMap').setView(currentCenter, 11);
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
}

// Hitung jarak
function calculateDistance(lat1, lon1, lat2, lon2) {
    if (!lat2 || !lon2) return 999;
    var R = 6371;
    var dLat = (lat2 - lat1) * Math.PI / 180;
    var dLon = (lon2 - lon1) * Math.PI / 180;
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
}

// Update marker di peta
function updateMap(schools) {
    markers.forEach(function(marker) {
        map.removeLayer(marker);
    });
    markers = [];

    schools.forEach(function(school) {
        if (school.latitude && school.longitude) {
            var lat = parseFloat(school.latitude);
            var lng = parseFloat(school.longitude);
            
            var color = (school.status === 'Negeri') ? '#2563eb' : '#10b981';
            var icon = L.divIcon({
                html: '<div style="background: ' + color + '; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">' +
                    '<i class="fas fa-school" style="color: white; font-size: 14px;"></i>' +
                    '</div>',
                iconSize: [36, 36],
                className: 'custom-marker'
            });

            var marker = L.marker([lat, lng], { icon: icon }).addTo(map);
            
            marker.bindPopup(`
                <div style="min-width: 200px;">
                    <strong style="font-size: 14px;">${school.nama_sekolah}</strong><br>
                    <small><i class="fas fa-map-marker-alt"></i> ${school.alamat || '-'}</small><br>
                    <small><i class="fas fa-graduation-cap"></i> ${school.jenjang} | Akreditasi ${school.akreditasi}</small><br>
                    <a href="https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}" target="_blank" style="font-size: 12px;">Lihat Rute →</a>
                </div>
            `);
            
            marker.on('click', function() {
                highlightSchoolCard(school.id_lokasi);
            });
            
            markers.push(marker);
        }
    });

    if (markers.length > 0) {
        var group = L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.1));
    }
}

// Highlight card sekolah
function highlightSchoolCard(id) {
    document.querySelectorAll('.school-card').forEach(function(card) {
        card.classList.remove('active');
        if (parseInt(card.dataset.id) === id) {
            card.classList.add('active');
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
}

// Render daftar sekolah
function renderSchools(schools) {
    var container = document.getElementById('schoolsListContainer');
    var stats = { sd: 0, smp: 0, sma: 0 };
    
    if (!schools || schools.length === 0) {
        container.innerHTML = `
            <div class="no-results">
                <i class="fas fa-school-circle-xmark"></i>
                <h5>Tidak ada sekolah ditemukan</h5>
                <p class="text-muted">Coba ubah filter pencarian Anda</p>
            </div>
        `;
        document.getElementById('totalSD').innerText = '0';
        document.getElementById('totalSMP').innerText = '0';
        document.getElementById('totalSMA').innerText = '0';
        document.getElementById('totalAll').innerText = '0';
        return;
    }
    
    var html = '';
    for (var i = 0; i < schools.length; i++) {
        var school = schools[i];
        var jenjangLower = school.jenjang.toLowerCase();
        
        if (jenjangLower.includes('sd')) stats.sd++;
        else if (jenjangLower.includes('smp')) stats.smp++;
        else if (jenjangLower.includes('sma') || jenjangLower.includes('smk')) stats.sma++;
        
        var jenjangClass = jenjangLower.includes('sd') ? 'badge-sd' : (jenjangLower.includes('smp') ? 'badge-smp' : 'badge-sma');
        var akreditasiClass = 'badge-' + (school.akreditasi ? school.akreditasi.toLowerCase() : 'c');
        var statusClass = (school.status || 'Negeri') === 'Negeri' ? 'badge-negeri' : 'badge-swasta';
        
        var distance = calculateDistance(currentCenter[0], currentCenter[1], 
            parseFloat(school.latitude), parseFloat(school.longitude));
        distance = distance < 999 ? distance.toFixed(1) : '?';
        
        var photoHtml = '';
        if (school.foto && school.foto !== '') {
            photoHtml = '<img src="' + BASE_URL + '/public/foto/' + school.foto + '" alt="' + school.nama_sekolah + '">';
        } else {
            photoHtml = '<div class="school-photo-placeholder"><i class="fas fa-school fa-2x"></i></div>';
        }
        
        html += `
            <div class="school-card" data-id="${school.id_lokasi}" data-lat="${school.latitude}" data-lng="${school.longitude}">
                <div class="school-row">
                    <div class="school-photo">
                        ${photoHtml}
                    </div>
                    <div class="school-info">
                        <div class="school-name">${escapeHtml(school.nama_sekolah)}</div>
                        <div class="school-address">
                            <i class="fas fa-map-marker-alt"></i> ${escapeHtml(school.alamat || '-')}
                        </div>
                        <div class="school-address">
                            <i class="fas fa-city"></i> Kec. ${escapeHtml(school.kecamatan || '-')}
                        </div>
                        <div class="school-badges">
                            <span class="badge-jenjang ${jenjangClass}">${school.jenjang}</span>
                            <span class="badge-akreditasi ${akreditasiClass}">Akreditasi ${school.akreditasi || 'C'}</span>
                            <span class="badge-status ${statusClass}">${school.status || 'Negeri'}</span>
                            <span class="distance-badge"><i class="fas fa-road"></i> ${distance} km</span>
                        </div>
                        <div class="school-actions">
                            <a href="https://www.google.com/maps/dir/?api=1&destination=${school.latitude},${school.longitude}" target="_blank" class="btn-route">
                                <i class="fas fa-directions"></i> Lihat Rute
                            </a>
                            <a href="${BASE_URL}/schools/detail/${school.id_lokasi}" class="btn-detail">
                                <i class="fas fa-info-circle"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
    
    container.innerHTML = html;
    document.getElementById('totalSD').innerText = stats.sd;
    document.getElementById('totalSMP').innerText = stats.smp;
    document.getElementById('totalSMA').innerText = stats.sma;
    document.getElementById('totalAll').innerText = schools.length;
    
    // Add click event to cards
    document.querySelectorAll('.school-card').forEach(function(card) {
        card.addEventListener('click', function() {
            var lat = parseFloat(this.dataset.lat);
            var lng = parseFloat(this.dataset.lng);
            if (lat && lng) {
                map.setView([lat, lng], 16);
                highlightSchoolCard(parseInt(this.dataset.id));
            }
        });
    });
}

// Escape HTML
function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Filter pencarian
function searchSchools() {
    var keyword = document.getElementById('searchKeyword').value;
    var jenjang = document.getElementById('jenjangFilter').value;
    var kecamatan = document.getElementById('kecamatanFilter').value;
    
    var url = BASE_URL + '/schools/search?';
    if (keyword) url += 'keyword=' + encodeURIComponent(keyword) + '&';
    if (jenjang && jenjang !== 'all') url += 'jenjang=' + encodeURIComponent(jenjang) + '&';
    if (kecamatan && kecamatan !== 'all') url += 'kecamatan=' + encodeURIComponent(kecamatan);
    
    window.location.href = url;
}

// Load kecamatan list
function loadKecamatan() {
    fetch(BASE_URL + '/schools/getKecamatan')
        .then(function(response) { return response.json(); })
        .then(function(data) {
            var select = document.getElementById('kecamatanFilter');
            for (var i = 0; i < data.length; i++) {
                var option = document.createElement('option');
                option.value = data[i];
                option.textContent = data[i];
                select.appendChild(option);
            }
        })
        .catch(function(error) {
            console.log('Error loading kecamatan:', error);
        });
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    initMap();
    loadKecamatan();
    renderSchools(allSchools);
    updateMap(allSchools);
    
    document.getElementById('searchBtn').addEventListener('click', searchSchools);
    document.getElementById('searchKeyword').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') searchSchools();
    });
});