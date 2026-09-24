<?php include 'koneksi.php'; ?>

<section id="keahlian" class="py-5 text-center">
    <div class="container py-5">
        <div class="section-badge">Expertise & Skills</div>

        <div class="row mt-4 text-left justify-content-center">
            <?php
            $query = "SELECT * FROM services ORDER BY id ASC";
            $result = mysqli_query($koneksi, $query);

            while ($row = mysqli_fetch_assoc($result)) :
                // Memecah teks tags bertanda koma menjadi array
                $tags = explode(',', $row['tags']);
            ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="skill-card">
                        <i class="<?= htmlspecialchars($row['ikon']); ?> skill-icon"></i>
                        <h3 class="font-weight-bold h4"><?= htmlspecialchars($row['judul']); ?></h3>
                        <p class="text-muted small mb-4">
                            <?= htmlspecialchars($row['deskripsi']); ?>
                        </p>
                        <div class="skill-tags">
                            <?php foreach ($tags as $tag) : ?>
                                <span><?= htmlspecialchars(trim($tag)); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>