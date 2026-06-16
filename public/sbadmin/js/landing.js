/**
 * Landing Page JavaScript
 * SIG Pemetaan Sekolah Kabupaten Tanah Datar
 * URL Tujuan: /search
 */

// ==================== BASE URL ====================
const BASE_URL = window.location.origin;

// ==================== DATA KECAMATAN ====================
const kecamatanList = [
    { name: "Batusangkar", area: "KECAMATAN", count: 0 },
    { name: "Lima Kaum", area: "KECAMATAN", count: 0 },
    { name: "Rambatan", area: "KECAMATAN", count: 0 },
    { name: "Pariangan", area: "KECAMATAN", count: 0 }
];

// ==================== LOAD STATISTIK DARI SERVER ====================
async function loadStatistics() {
    try {
        const response = await fetch(BASE_URL + '/lokasi/getStatistics');
        const data = await response.json();
        
        if (data.success) {
            animateCounter(document.getElementById('totalSekolah'), data.total_all);
            animateCounter(document.getElementById('totalSD'), data.total_sd);
            animateCounter(document.getElementById('totalSMP'), data.total_smp);
            animateCounter(document.getElementById('totalSMA'), data.total_sma);
            
            // Update kecamatan counts
            kecamatanList.forEach(kec => {
                const found = data.per_kecamatan?.find(k => k.kecamatan === kec.name);
                if (found) {
                    kec.count = found.jumlah;
                }
            });
        } else {
            setFallbackData();
        }
    } catch (error) {
        console.error('Error loading statistics:', error);
        setFallbackData();
    }
    renderKecamatanCards();
}

function setFallbackData() {
    document.getElementById('totalSekolah').innerText = '247';
    document.getElementById('totalSD').innerText = '156';
    document.getElementById('totalSMP').innerText = '58';
    document.getElementById('totalSMA').innerText = '33';
    
    const dummyCounts = [42, 35, 28, 25];
    kecamatanList.forEach((kec, idx) => {
        kec.count = dummyCounts[idx];
    });
}

function animateCounter(element, target) {
    if (!element) return;
    
    let current = 0;
    const increment = target / 50;
    
    const updateCounter = () => {
        current += increment;
        if (current < target) {
            element.innerText = Math.floor(current);
            requestAnimationFrame(updateCounter);
        } else {
            element.innerText = target;
        }
    };
    updateCounter();
}

// ==================== RENDER KARTU KECAMATAN ====================
function renderKecamatanCards() {
    const container = document.getElementById('kecamatanContainer');
    if (!container) return;
    
    container.innerHTML = '';
    
    kecamatanList.forEach((kec) => {
        const imageName = kec.name.toLowerCase().replace(/ /g, '-');
        const imageUrl = BASE_URL + `/sbadmin/img/${imageName}.jpg`;
        
        const card = document.createElement('div');
        card.className = 'col-lg-3 col-md-6';
        card.innerHTML = `
            <div class="card-image-wrapper" data-kecamatan="${kec.name}" style="cursor: pointer;">
                <div class="card-bg-img" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0) 40%, rgba(0,0,0,0.85) 100%), url('${imageUrl}'); background-size: cover; background-position: center; border-radius: 16px; height: 200px; position: relative;">
                    <div class="card-overlay-content" style="position: absolute; bottom: 0; left: 0; right: 0; padding: 20px; color: white;">
                        <span class="region-tag" style="font-size: 12px; opacity: 0.8;">${kec.area}</span>
                        <h4 class="region-name" style="font-size: 20px; font-weight: 700; margin: 5px 0 0 0;">${kec.name}</h4>
                    </div>
                </div>
            </div>
            <div class="card-footer-meta d-flex justify-content-between align-items-center mt-2 px-1">
                <span class="school-count-text">${kec.count} Sekolah</span>
            </div>
        `;
        
        container.appendChild(card);
    });
    
    // Event klik card kecamatan -> redirect ke /search
    document.querySelectorAll('.card-image-wrapper').forEach(card => {
        card.addEventListener('click', function(e) {
            const kecamatan = this.dataset.kecamatan;
            const url = BASE_URL + `/search?kecamatan=${encodeURIComponent(kecamatan)}`;
            console.log('Redirect ke:', url);
            window.location.href = url;
        });
    });
}

// ==================== TOMBOL CARI ====================
function setupSearchButton() {
    const searchBtn = document.getElementById('searchBtn');
    const lokasiInput = document.getElementById('lokasi');
    const jenjangSelect = document.getElementById('jenjang');
    
    if (!searchBtn) {
        console.log('Tombol search tidak ditemukan');
        return;
    }
    
    searchBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        const lokasi = lokasiInput?.value || '';
        const jenjang = jenjangSelect?.value || 'all';
        
        let jenjangParam = '';
        if (jenjang !== 'all') {
            jenjangParam = jenjang;
        }
        
        let url = BASE_URL + '/search?';
        if (lokasi) url += `kecamatan=${encodeURIComponent(lokasi)}&`;
        if (jenjangParam) url += `jenjang=${jenjangParam}`;
        
        // Bersihkan URL
        if (url.endsWith('&') || url.endsWith('?')) {
            url = url.slice(0, -1);
        }
        
        console.log('Redirect ke:', url);
        window.location.href = url;
    });
    
    // Enter key pada input
    if (lokasiInput) {
        lokasiInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchBtn.click();
            }
        });
    }
}

// ==================== ANIMASI SCROLL REVEAL ====================
function setupScrollReveal() {
    const elements = document.querySelectorAll('.card-image-wrapper, .hero-badge, .hero-title, .search-capsule-container, .hero-stats-row');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, idx) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, idx * 60);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -20px 0px' });
    
    elements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(25px)';
        el.style.transition = 'opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1)';
        observer.observe(el);
    });
}

// ==================== NAVBAR SCROLL EFFECT ====================
function setupNavbarEffect() {
    const navbar = document.querySelector('.navbar');
    if (!navbar) return;
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.05)';
            navbar.style.padding = '0.6rem 0';
        } else {
            navbar.style.boxShadow = 'none';
            navbar.style.padding = '0.9rem 0';
        }
    });
}

// ==================== SMOOTH SCROLL UNTUK ANCHOR ====================
function setupSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
}

// ==================== TUTUP NAVBAR DI MOBILE ====================
function setupMobileNavbar() {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (!navbarToggler || !navbarCollapse) return;
    
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        link.addEventListener('click', () => {
            if (navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
    });
}

// ==================== INITIALIZE ====================
document.addEventListener('DOMContentLoaded', () => {
    console.log('Landing page ready - BASE_URL:', BASE_URL);
    console.log('URL tujuan: /search');
    
    loadStatistics();
    setupSearchButton();
    setupScrollReveal();
    setupNavbarEffect();
    setupSmoothScroll();
    setupMobileNavbar();
});