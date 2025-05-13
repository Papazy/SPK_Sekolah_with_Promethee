  <?= $this->extend('layouts/admin') ?>

  <?= $this->section('content') ?>

  <div class="container mt-4">
    <div class="card shadow-sm rounded-4">
      <div class="card-body p-4">
        <h2 class="fw-bold text-success">Input Kriteria untuk PAUD <?= esc($paud['nama']) ?></h2>
        <hr>

        <form action="/admin/paud/save-kriteria" method="post">
          <input type="hidden" name="paud_id" value="<?= $paud['id'] ?>">

          <?php $index = 1; ?>
          <?php foreach ($kriteria as $k): ?>
            <div class="mb-4">
              <label class="form-label fw-semibold"><?= 'C' . $index; ?> <?= esc($k['nama']) ?></label>
              <div class="btn-group w-100" role="group" aria-label="Rating">
                <?php for ($i = 1; $i <= 6; $i++): ?>
                  <input type="radio" class="btn-check"
                    name="kriteria[<?= $k['id'] ?>]"
                    id="kriteria<?= $k['id'] ?>-<?= $i ?>"
                    value="<?= $i ?>"
                    <?= (isset($nilaiMap[$k['id']]) && $nilaiMap[$k['id']] == $i) ? 'checked' : '' ?>>
                  <label class="btn btn-outline-success" for="kriteria<?= $k['id'] ?>-<?= $i ?>"><?= $i ?></label>
                <?php endfor; ?>
              </div>
            </div>
            <?php $index++; ?>
          <?php endforeach; ?>
          <div class="alert alert-info mt-4" role="alert">
            <strong>Note:</strong> Skala penilaian adalah sebagai berikut:
            <ul class="mt-2 mb-0">
              <li>5 - Sangat Baik</li>
              <li>4 - Baik</li>
              <li>3 - Cukup</li>
              <li>2 - Kurang</li>
              <li>1 - Sangat Kurang</li>
            </ul>
          </div>

          <button type="submit" class="btn btn-success rounded-3 shadow-sm mt-4">Simpan Nilai</button>
        </form>
      </div>
    </div>
  </div>

  <?= $this->endSection() ?>