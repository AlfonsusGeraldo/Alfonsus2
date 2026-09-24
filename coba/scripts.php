<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>

<script>
    /* =====================================================
       1. MENU ACTIVE SESUAI SECTION
       ===================================================== */
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(".nav-link");

    function setActiveMenu() {
        let currentSection = "";
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 150;
            const sectionHeight = section.offsetHeight;
            if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                currentSection = section.getAttribute("id");
            }
        });

        navLinks.forEach(link => {
            link.classList.remove("active");
            if (link.getAttribute("href") === "#" + currentSection) {
                link.classList.add("active");
            }
        });
    }

    window.addEventListener("scroll", setActiveMenu);
    window.addEventListener("load", setActiveMenu);

    /* =====================================================
       2. SMOOTH AUTOSCROLL MENU
       ===================================================== */
    navLinks.forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            const targetId = this.getAttribute("href");
            const targetSection = document.querySelector(targetId);

            if (targetSection) {
                const navbarHeight = document.querySelector(".navbar").offsetHeight;
                const targetPosition = targetSection.offsetTop - navbarHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: "smooth"
                });

                navLinks.forEach(item => item.classList.remove("active"));
                this.classList.add("active");

                if (window.innerWidth < 992) {
                    $("#navbarNav").collapse("hide");
                }
            }
        });
    });

    /* =====================================================
       3. REAL-TIME CHART JS (UPDATE OTOMATIS SETIAP 5 DETIK)
       ===================================================== */
    const chartCanvas = document.getElementById("skillChart");
    if (chartCanvas) {
        // Inisialisasi awal Chart dengan data kosong
        const skillChart = new Chart(chartCanvas, {
            type: "bar",
            data: {
                labels: [],
                datasets: [{
                    label: "Tingkat Penguasaan (%)",
                    data: [],
                    borderWidth: 2,
                    borderColor: "#1a1a1a",
                    backgroundColor: [
                        "#d1e2fc",
                        "#fff2cc",
                        "#d5ebd3",
                        "#ffd1d1",
                        "#e2d1fc"
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: true },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: { display: true, text: "Persentase (%)" }
                    },
                    x: {
                        title: { display: true, text: "Kategori Keahlian" }
                    }
                }
            }
        });

        // Fungsi AJAX/Fetch untuk mengambil data dari get_chart_data.php
        function fetchChartData() {
            fetch('get_chart_data.php')
                .then(response => response.json())
                .then(data => {
                    // Update data dan label pada grafik
                    skillChart.data.labels = data.labels;
                    skillChart.data.datasets[0].data = data.data;
                    
                    // Render ulang grafik dengan animasi halus
                    skillChart.update();
                })
                .catch(error => console.error('Gagal memuat data grafik:', error));
        }

        // 1. Panggil pertama kali saat halaman dibuka
        fetchChartData();

        // 2. PENGATURAN TIMER REAL-TIME (5 Detik = 5000 Milidetik)
        setInterval(fetchChartData, 5000);
    }

    /* =====================================================
       4. PROSES KIRIM PESAN AJAX (PENGIRIMAN KE DATABASE)
       ===================================================== */
    const contactForm = document.getElementById("contactForm");
    if (contactForm) {
        contactForm.addEventListener("submit", function(e) {
            e.preventDefault();

            const formAlert = document.getElementById("formAlert");
            const btnSubmit = document.getElementById("btnSubmit");
            const formData = new FormData(this);

            // Ubah tombol jadi status memuat
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';

            fetch('simpan_pesan.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    formAlert.innerHTML = `
                        <div class="alert alert-success border border-dark mb-4">
                            <i class="fas fa-check-circle mr-2"></i> ${data.message}
                        </div>`;
                    contactForm.reset(); // Kosongkan formulir
                } else {
                    formAlert.innerHTML = `
                        <div class="alert alert-danger border border-dark mb-4">
                            <i class="fas fa-exclamation-circle mr-2"></i> ${data.message}
                        </div>`;
                }
            })
            .catch(error => {
                formAlert.innerHTML = `
                    <div class="alert alert-danger border border-dark mb-4">
                        <i class="fas fa-exclamation-triangle mr-2"></i> Terjadi kesalahan koneksi.
                    </div>`;
            })
            .finally(() => {
                // Kembalikan tombol ke keadaan semula
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Kirim Pesan';
            });
        });
    }
</script>