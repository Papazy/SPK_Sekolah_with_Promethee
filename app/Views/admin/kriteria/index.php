<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2 class="fw-bold text-success">Daftar Kriteria</h2>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success mt-3"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('deleted')): ?>
    <div class="alert alert-danger mt-3"><?= session()->getFlashdata('deleted') ?></div>
  <?php endif; ?>

  <div class="card mt-4 shadow-sm rounded-4">
    <div class="card-body">
      <form action="/admin/kriteria/store" method="post" class="row g-2 align-items-end">
        <div class="col-md-6">
          <label class="form-label">Nama Kriteria</label>
          <input type="text" class="form-control" name="nama" placeholder="Contoh: Kualitas Kurikulum" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Jenis</label>
          <select class="form-select" name="jenis" required>
            <option value="benefit">Benefit</option>
            <option value="cost">Cost</option>
          </select>
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-success w-100"><i class="bi bi-plus-lg"></i> Tambah</button>
        </div>
      </form>
    </div>
  </div>

  <div class="table-responsive mt-4">
    <table class="table table-hover align-middle">
      <thead class="table-success">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Jenis</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; foreach ($kriteria as $k): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($k['nama']) ?></td>
            <td class="text-capitalize"><?= esc($k['jenis']) ?></td>
            <td>
              <!-- Edit Modal -->
              <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $k['id'] ?>">Edit</button>
              <a href="/admin/kriteria/delete/<?= $k['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>

              <div class="modal fade" id="editModal<?= $k['id'] ?>" tabindex="-1">
                <div class="modal-dialog">
                  <form class="modal-content" action="/admin/kriteria/update/<?= $k['id'] ?>" method="post">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Kriteria</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?= esc($k['nama']) ?>" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Jenis</label>
                        <select class="form-select" name="jenis" required>
                          <option value="benefit" <?= $k['jenis'] === 'benefit' ? 'selected' : '' ?>>Benefit</option>
                          <option value="cost" <?= $k['jenis'] === 'cost' ? 'selected' : '' ?>>Cost</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
