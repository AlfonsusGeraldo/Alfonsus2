<section id="contact" class="py-5 text-center">
    <div class="container py-5">
        <div class="section-badge">Contact Me</div>

        <div class="row mt-4 text-left justify-content-center">
            <div class="col-lg-4 mb-4">
                <h3 class="font-weight-bold mb-4">Mari Berdiskusi</h3>

                <div class="contact-info-card">
                    <i class="fas fa-map-marker-alt text-danger"></i>
                    <div>
                        <h6 class="mb-0 font-weight-bold">Lokasi</h6>
                        <small class="text-muted">Surakarta, Jawa Tengah, Indonesia</small>
                    </div>
                </div>

                <div class="contact-info-card">
                    <i class="fas fa-envelope text-primary"></i>
                    <div>
                        <h6 class="mb-0 font-weight-bold">Email</h6>
                        <small class="text-muted">alfonsusgeral@email.com</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 offset-lg-1">
                <div class="card border-dark shadow p-4" style="border-radius: 12px;">
                    
                    <!-- Tempat Notifikasi Berhasil/Gagal -->
                    <div id="formAlert"></div>

                    <form id="contactForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="font-weight-bold">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" id="name" placeholder="Masukkan nama..." required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="font-weight-bold">Alamat Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="message" class="font-weight-bold">Pesan / Proyek</label>
                            <textarea name="pesan" class="form-control" id="message" rows="5" placeholder="Tuliskan pesan Anda..." required></textarea>
                        </div>

                        <button type="submit" id="btnSubmit" class="btn btn-custom btn-block py-3">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>