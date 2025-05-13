  <?= $this->extend('layouts/admin') ?>

  <?= $this->section('content') ?>

  <div class="container mt-4">
    <div class="card shadow-sm rounded-4">
      <div class="card-body p-4">
        <h2 class="fw-bold text-success">Tambah PAUD</h2>
        <hr>
        <?php if (session()->getFlashdata('errors')): ?>
          <div class="alert alert-danger">
            <ul>
              <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= $error ?></li>
              <?php endforeach ?>
            </ul>
          </div>
        <?php endif ?>
        <?php $errors = session()->getFlashdata('errors') ?? []; ?>

        <form action="/admin/paud/store" method="post">
          <?= csrf_field() ?>
          <div class="mt-3">
            <div class="d-flex align-items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building-fill-add" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0" />
                <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v7.256A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-3.59 1.787A.5.5 0 0 0 9 9.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .39-.187A4.5 4.5 0 0 0 8.027 12H6.5a.5.5 0 0 0-.5.5V16H3a1 1 0 0 1-1-1zm2 1.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5m3 0v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5m3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5M7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5M4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
              </svg>
              <h4 class="text-success">Identitas Sekolah</h4>
            </div>
            <div class="row mb-3 align-items-center">
              <label for="NPSN" class="col-sm-2 col-form-label">NPSN</label>
              <div class="col-sm-8">
                <input type="text" class="form-control <?= (session('errors.npsn') ? 'is-invalid' : '') ?>" id="NPSN" name="npsn" value="<?= old('npsn') ?>" placeholder="NPSN Sekolah">
                <?php if (isset($errors['npsn'])): ?>
                  <div class="text-danger"><?= $errors['npsn'] ?></div>
                <?php endif ?>
              </div>
            </div>
            <div class="row mb-3 align-items-center">
              <label for="nama" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-8">
                <input type="text" class="form-control <?= (session('errors.nama') ? 'is-invalid' : '') ?>" id="nama" name="nama" value="<?= old('nama') ?>" placeholder="Nama Sekolah">

                <?php if (isset($errors['nama'])): ?>
                  <div class="text-danger"><?= $errors['nama'] ?></div>
                <?php endif ?>
              </div>
            </div>

            <div class="row mb-3 align-items-start">
              <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
              <div class="col-sm-2">
                <select class="form-select <?= (session('errors.kecamatan') ? 'is-invalid' : '') ?>" id="kecamatan" name="kecamatan">
                  <option value="" disabled <?= old('kecamatan') ? '' : 'selected' ?>>-- Pilih Kecamatan</option>
                  <?php
                  $kecamatanList = [
                    'Gandapura',
                    'Jangka',
                    'Jeumpa',
                    'Jeunieb',
                    'Juli',
                    'Kota Juang',
                    'Kuala',
                    'Kuta Blang',
                    'Makmur',
                    'Pandrah',
                    'Peudada',
                    'Peulimbang',
                    'Peusangan',
                    'Peusangan Selatan',
                    'Peusangan Siblah Krueng',
                    'Samalanga',
                    'Simpang Mamplam'
                  ];
                  foreach ($kecamatanList as $kecamatan): ?>
                    <option value="<?= $kecamatan ?>" <?= old('kecamatan') == $kecamatan ? 'selected' : '' ?>><?= $kecamatan ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="row mb-3 align-items-start">
              <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-8">
                <textarea class="form-control <?= (session('errors.alamat') ? 'is-invalid' : '') ?>" id="alamat" name="alamat" rows="3"><?= old('alamat') ?></textarea>
                <?php if (isset($errors['alamat'])): ?>
                  <div class="text-danger"><?= $errors['alamat'] ?></div>
                <?php endif ?>
              </div>
            </div>

            <div class="row mb-3 align-items-start">
              <label for="status" class="col-sm-2">Status</label>
              <div class="col-sm-2">
                <select class="form-select <?= (session('errors.status') ? 'is-invalid' : '') ?>" id="status" name="status">
                  <option value="" disabled <?= old('status') ? '' : 'selected' ?>>-- Pilih status</option>
                  <option value="negeri" <?= old('status') == 'negeri' ? 'selected' : '' ?>>Negeri</option>
                  <option value="swasta" <?= old('status') == 'swasta' ? 'selected' : '' ?>>Swasta</option>
                </select>
              </div>
            </div>

            <div class="row mb-3 align-items-start">
              <label for="akreditasi" class="col-sm-2">Akreditasi</label>
              <div class="col-sm-2">
                <select class="form-select <?= (session('errors.akreditasi') ? 'is-invalid' : '') ?>" id="akreditasi" name="akreditasi">
                  <option value="" disabled <?= old('akreditasi') ? '' : 'selected' ?>>-- Pilih akreditasi</option>
                  <?php foreach (['Unggul', 'A', 'B', 'C', 'D', 'E'] as $akreditasi): ?>
                    <option value="<?= $akreditasi ?>" <?= old('akreditasi') == $akreditasi ? 'selected' : '' ?>><?= $akreditasi ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Koordinat</label>
              <div class="col-sm-5">
                <div class="row">
                  <div class="col-sm-6">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input
                      type="text"
                      class="form-control <?= (session('errors.latitude') ? 'is-invalid' : '') ?>"
                      id="latitude"
                      name="latitude"
                      value="<?= old('latitude') ?>"
                      placeholder="5.xxxxxxx">
                    <?php if (isset($errors['latitude'])): ?>
                      <div class="invalid-feedback d-block"><?= $errors['latitude'] ?></div>
                    <?php endif ?>
                  </div>
                  <div class="col-sm-6">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input
                      type="text"
                      class="form-control <?= (session('errors.longitude') ? 'is-invalid' : '') ?>"
                      id="longitude"
                      name="longitude"
                      value="<?= old('longitude') ?>"
                      placeholder="96.xxxxxxx">
                    <?php if (isset($errors['longitude'])): ?>
                      <div class="invalid-feedback d-block"><?= $errors['longitude'] ?></div>
                    <?php endif ?>
                  </div>
                </div>
              </div>
            </div>
            <hr class="mt-4">
            <div class=" d-flex align-items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building-fill-add" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0" />
                <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v7.256A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-3.59 1.787A.5.5 0 0 0 9 9.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .39-.187A4.5 4.5 0 0 0 8.027 12H6.5a.5.5 0 0 0-.5.5V16H3a1 1 0 0 1-1-1zm2 1.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5m3 0v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5m3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5M7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5M4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
              </svg>
              <h4 class="text-success">Informasi Akademik</h4>
            </div>

            <div class="row mb-3 align-items-center">
              <label for="kepala_paud" class="col-sm-2 col-form-label fs-7">Kepala PAUD</label>
              <div class="col-sm-4 d-flex">
                <input type="text" class="form-control <?= (session('errors.kepala_paud') ? 'is-invalid' : '') ?>" id="kepala_paud" name="kepala_paud" value="<?= old('kepala_paud') ?>" placeholder="Nama Kepala PAUD">
                <?php if (isset($errors['kepala_paud'])): ?>
                  <div class="text-danger"><?= $errors['kepala_paud'] ?></div>
                <?php endif ?>
              </div>
            </div>

            <div class="row mb-3 align-items-center">
              <label for="biaya" class="col-sm-2 col-form-label">Biaya SPP</label>
              <div class="col-sm-4 d-flex">
                <span class="input-group-text">Rp.</span>
                <input type="text" class="form-control <?= (session('errors.biaya_spp') ? 'is-invalid' : '') ?>" id="biaya" name="biaya_spp" value="<?= old('biaya_spp') ?>"
                  oninput="this.value = formatRupiah(this.value)"
                  onblur="this.value = removeDots(this.value)">
                <?php if (isset($errors['biaya_spp'])): ?>
                  <div class="text-danger"><?= $errors['biaya_spp'] ?></div>
                <?php endif ?>
              </div>
            </div>

            <script>
              function formatRupiah(value) {
                return value.replace(/\D/g, '')
                  .replace(/\B(?=(\d{3})+(?!\d))/g, '.');
              }

              function removeDots(value) {
                return value.replace(/\./g, '');
              }
            </script>

            <button type="submit" class="btn btn-success rounded-3 shadow-sm">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?= $this->endSection() ?>