// public/sbadmin/js/search-schools.js

// --- Global variables ---
var map;
var markers = [];
var selectedSchools = [];
var currentSchools = [];

// Koordinat pusat (Default Jakarta Center atau Tanah Datar)
var centerLat = -0.4464;
var centerLng = 100.5872;

// --- Inisialisasi ---
document.addEventListener('DOMContentLoaded', function() {
    initMap();
    setupEventListeners();
});

function initMap() {
    map = L.map('searchMap', { zoomControl: false }).setView([centerLat, centerLng], 12);
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png').addTo(map);
    L.control.zoom({ position: 'bottomright' }).addTo(map);
}

// --- Logika Utama ---
function setupEventListeners() {
    // Event untuk tombol "Bandingkan Sekarang"
    document.querySelector('.btn-bandingkan-sekarang').addEventListener('click', goToCompare);
    
    // Logika pemilihan sekolah (di delegasikan ke container list)
    document.getElementById('schoolList').addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-compare-small')) {
            var card = e.target.closest('.school-card');
            var id = parseInt(card.getAttribute('data-id'));
            toggleCompare(id, e.target);
        }
    });
}

function toggleCompare(id, btnElement) {
    var index = selectedSchools.indexOf(id);
    
    if (index === -1) {
        if (selectedSchools.length < 3) {
            selectedSchools.push(id);
            btnElement.innerText = "Batal";
            btnElement.style.background = "#fee2e2"; // Merah muda lembut
            btnElement.style.color = "#dc2626";
        } else {
            alert('Maksimal 3 sekolah untuk dibandingkan');
            return;
        }
    } else {
        selectedSchools.splice(index, 1);
        btnElement.innerText = "Pilih Bandingkan";
        btnElement.style.background = "#f1f5f9";
        btnElement.style.color = "#475569";
    }

    updateCompareWidget();
}

// Update widget "2 Sekolah Dipilih" di bawah
function updateCompareWidget() {
    var count = selectedSchools.length;
    var widget = document.querySelector('.compare-widget');
    
    // Menampilkan/menyembunyikan widget berdasarkan jumlah pilihan
    widget.style.display = count >= 2 ? 'flex' : 'none';
    document.querySelector('.compare-text').innerText = count + " Sekolah Dipilih";
}

function goToCompare() {
    if (selectedSchools.length >= 2) {
        window.location.href = BASE_URL + '/search/compare?ids=' + selectedSchools.join(',');
    }
}

// --- Render List (Disesuaikan dengan HTML baru) ---
function renderSchools(schools) {
    var container = document.getElementById('schoolList');
    var html = '';

    schools.forEach(function(school) {
        var isSelected = selectedSchools.includes(school.id_lokasi);
        
        html += `
        <div class="school-card" data-id="${school.id_lokasi}">
            <div class="school-header-row">
                <div class="school-photo">
                    <img src="${school.foto ? BASE_URL + '/public/foto/' + school.foto : 'https://via.placeholder.com/80'}" alt="${school.nama_sekolah}">
                </div>
                <div class="school-info">
                    <div class="info-top">
                        <div>
                            <h3 class="school-name">${school.nama_sekolah}</h3>
                            <p class="school-address">${school.alamat}</p>
                        </div>
                        <span class="akreditasi-badge ${school.akreditasi === 'B' ? 'gray-badge' : ''}">AKREDITASI ${school.akreditasi}</span>
                    </div>
                    <div class="school-details">
                        <span><i class="fa-solid fa-location-dot"></i> ${school.distance ? school.distance.toFixed(1) : 0} km</span>
                        <span><i class="fa-solid fa-graduation-cap"></i> ${school.status}</span>
                    </div>
                </div>
            </div>
            <div class="school-actions">
                <button class="btn-route" onclick="window.open('...', '_blank')">Lihat Rute</button>
                <button class="btn-compare-small">${isSelected ? 'Batal' : 'Pilih Bandingkan'}</button>
            </div>
        </div>`;
    });

    container.innerHTML = html;
}