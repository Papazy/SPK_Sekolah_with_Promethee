<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
  <div class="card shadow-sm rounded-4">
    <div class="card-body p-4">
      <h2 class="fw-bold text-success mb-4"><?= esc($paud['nama']) ?></h2>

      <div class="row mb-3">
        <div class="col-md-6">
          <p><strong>NPSN:</strong> <?= esc($paud['npsn']) ?></p>
          <p><strong>Alamat:</strong> <?= esc($paud['alamat']) ?></p>
          <p><strong>Kecamatan:</strong> <?= esc($paud['kecamatan']) ?></p>
          <p><strong>Status:</strong> 
            <?php if ($paud['status'] === 'negeri'): ?>
              <span class="badge bg-primary">Negeri</span>
            <?php else: ?>
              <span class="badge bg-secondary">Swasta</span>
            <?php endif; ?>
          </p>
        </div>
        <div class="col-md-6">
          <p><strong>Akreditasi:</strong> <?= esc($paud['akreditasi']) ?></p>
          <p><strong>Latitude:</strong> <?= esc($paud['latitude']) ?></p>
          <p><strong>Longitude:</strong> <?= esc($paud['longitude']) ?></p>
          <p><strong>Kepala PAUD:</strong> <?= esc($paud['kepala_sekolah']) ?></p>
          <p><strong>Biaya SPP:</strong> Rp <?= number_format($paud['biaya_spp'], 0, ',', '.') ?></p>
        </div>
      </div>

      <hr>

      <h4 class="fw-bold text-primary mb-3">Kriteria Penilaian</h4>

      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Kriteria</th>
              <th>Nilai</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($kriteria)): ?>
              <?php $no = 1; foreach ($kriteria as $k): ?>
                <?php if($k['nama'] == 'Jarak Sekolah dari Rumah' ){
                  continue;
                }
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= esc($k['nama']) ?></td>
                  <td class="text-center"><?= intval($k['nilai']) ?></td>
                  
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center text-muted py-4">
                  <i class="bi bi-info-circle"></i> Belum ada data kriteria.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <a href="/admin/paud" class="btn btn-secondary rounded-3 mt-4">Kembali</a>

    </div>
  </div>
</div>

<?= $this->endSection() ?>
