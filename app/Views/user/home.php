<?= $this->extend('layouts/user') ?>

<?= $this->section('content') ?>
<div class="container text-center mt-5">
  <h1 class="fw-bold text-success">SPK Pemilihan Sekolah PAUD</h1>
  <p class="lead mt-3">Sistem ini membantu Anda menemukan PAUD terbaik berdasarkan kriteria seperti metode pengajaran, kurikulum, fasilitas, dan lainnya.</p>
  <a href="/spk" class="btn btn-success btn-lg mt-4">Mulai Rekomendasi</a>
  <?php if (!empty($paudList)): ?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Sekolah PAUD</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-success text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kecamatan</th>
                    <th>Status</th>
                    <th>Akreditasi</th>
                    <th>Reputasi</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paudList as $i => $paud): ?>
                    <tr>
                        <td class="text-center"><?= $i + 1 ?></td>
                        <td><?= esc($paud['nama']) ?></td>
                        <td><?= esc($paud['alamat']) ?></td>
                        <td><?= esc($paud['kecamatan']) ?></td>
                        <td>
                  <?php if ($paud['status'] === 'negeri'): ?>
                    <div class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm">Negeri</div>
                  <?php else: ?>
                    <div class="badge bg-warning text-white px-3 py-2 rounded-pill shadow-sm">Swasta</div>
                  <?php endif; ?>
                </td>
                        <td class="text-center"><?= esc($paud['akreditasi']) ?></td>
                        <td class="text-center"><?= esc($paud['reputasi']) ?></td>
                        <td class="text-center">
    <?php if (!empty($paud['latitude']) && !empty($paud['longitude'])): ?>
        <a href="https://www.google.com/maps?q=<?= $paud['latitude'] ?>,<?= $paud['longitude'] ?>" target="_blank" class="btn btn-sm btn-outline-success">
            Lihat Map
        </a>
    <?php else: ?>
        <span class="text-muted">Tidak tersedia</span>
    <?php endif; ?>
</td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif ?>
</div>
<?= $this->endSection() ?>
