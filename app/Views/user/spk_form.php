<?= $this->extend('layouts/user') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
  <h2 class="fw-bold text-success mb-4">Tentukan Prioritas Anda</h2>
  <p class="text-muted">Pilih tingkat kepentingan untuk setiap kriteria di bawah ini (1: tidak penting, 5: sangat penting).</p>

  <form action="/spk/hitung" method="post">
    <?php foreach ($kriteria as $k): ?>
      <div class="mb-4">
        <label class="form-label fw-semibold"><?= esc($k['nama']) ?> (<?= esc($k['jenis']) ?>)</label>
        <div class="btn-group w-100" role="group" aria-label="Tingkat Kepentingan">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <input type="radio" class="btn-check" name="bobot[<?= $k['id'] ?>]" id="k<?= $k['id'] ?>-<?= $i ?>" value="<?= $i ?>" required>
            <label class="btn btn-outline-success" for="k<?= $k['id'] ?>-<?= $i ?>"><?= $i ?></label>
          <?php endfor; ?>
        </div>
      </div>
    <?php endforeach; ?>

    <button type="submit" class="btn btn-success rounded-3 shadow-sm mt-3">Lihat Rekomendasi</button>
  </form>
</div>
<?= $this->endSection() ?>
