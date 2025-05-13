<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h2 class="fw-bold text-success">Data PAUD</h2>
  <a href="/admin/paud/create" class="btn btn-success rounded-3 shadow-sm">
    <i class="bi bi-plus-lg"></i> Tambah PAUD
  </a>
</div>


<!-- toast -->
<?php if (session()->getFlashdata('success')): ?>
  <div id="successToast" class="custom-toast toast-success">
    <?= session()->getFlashdata('success') ?>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toast = document.getElementById('successToast');
      setTimeout(() => {
        toast.classList.add('fade-out');
      }, 3000);
      toast.addEventListener('animationend', function () {
        if (toast.classList.contains('fade-out')) {
          toast.remove();
        }
      });
    });
  </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
  <div id="errorToast" class="custom-toast toast-error">
    <?= session()->getFlashdata('error') ?>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toast = document.getElementById('errorToast');
      setTimeout(() => {
        toast.classList.add('fade-out');
      }, 3000);
      toast.addEventListener('animationend', function () {
        if (toast.classList.contains('fade-out')) {
          toast.remove();
        }
      });
    });
  </script>
<?php endif; ?>

<?php if (session()->getFlashdata('deleted')): ?>
  <div id="deletedToast" class="custom-toast toast-error">
    <?= session()->getFlashdata('deleted') ?>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toast = document.getElementById('deletedToast');
      setTimeout(() => {
        toast.classList.add('fade-out');
      }, 3000);
      toast.addEventListener('animationend', function () {
        if (toast.classList.contains('fade-out')) {
          toast.remove();
        }
      });
    });
  </script>
<?php endif; ?>

<!-- endtoast -->


<div class="card shadow-sm rounded-4">
  <div class="card-body p-4">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="bg-success text-white">
          <tr>
            <th>No</th>
            <th>Nama PAUD</th>
            <th>Kecamatan</th>
            <th>Akreditasi</th>
            <th>Status</th>
            <th>Kriteria</th>
            <th>Detail</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($paud)): ?>
            <tr>
              <td colspan="7" class="text-center text-muted py-5">
                <i class="bi bi-info-circle"></i> Belum ada data.
              </td>
            </tr>
          <?php else: ?>
            <?php $noKriteria = 1;
            foreach ($paud as $s): ?>
              <tr>
                <td><?= $noKriteria++ ?></td>
                <td class="fw-semibold"><?= esc($s['nama']) ?></td>
                <td><?= esc($s['kecamatan']) ?></td>
                <td><?= esc($s['alamat']) ?></td>
                <td>
                  <?php if ($s['status'] === 'negeri'): ?>
                    <div class="badge bg-primary text-white px-3 py-2 rounded-pill shadow-sm">Negeri</div>
                  <?php else: ?>
                    <div class="badge bg-secondary text-white px-3 py-2 rounded-pill shadow-sm">Swasta</div>
                  <?php endif; ?>
                </td>
                <td>
                  <button type="button" class="btn btn-success btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#kriteriaModal<?= $s['id'] ?>">
                    <i class="bi bi-list-check"></i> Kriteria
                  </button>
                  <!-- Modal -->
                  <div class="modal fade" id="kriteriaModal<?= $s['id'] ?>" tabindex="-1" aria-labelledby="kriteriaModalLabel<?= $s['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="kriteriaModalLabel<?= $s['id'] ?>">Kriteria PAUD</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                              <thead class="table-light">
                                <tr>
                                  <th style="width: 5%;">No</th>
                                  <th>Kriteria</th>
                                  <th>Nilai</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($s['kriteria'])): ?>
                                  <?php $no = 1;
                                  foreach ($s['kriteria'] as $kriteria): ?>
                                    <tr>
                                      <td>C<?= $no++ ?></td>
                                      <td><?= esc($kriteria['nama']) ?> </td>
                                      <td class="text-center">
                                        <?= $kriteria['nilai'] !== null ? intval($kriteria['nilai']) : '-' ?>
                                      </td>
                                    </tr>
                                  <?php endforeach; ?>
                                <?php else: ?>
                                  <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                      <i class="bi bi-info-circle"></i> Belum ada data kriteria.
                                    </td>
                                  </tr>
                                <?php endif; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <a href="/admin/paud/kriteria/<?= $s['id'] ?>/input" class="btn btn-success">Ubah Kriteria</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                  <a href="/admin/paud/detail/<?= $s['id'] ?>" class="btn btn-success btn-sm">Detail</a>
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $s['id'] ?>">
                    Delete
                  </button>
                  <!-- Delete Confirmation Modal -->
                  <div class="modal fade" id="deleteModal<?= $s['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $s['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                          <h5 class="modal-title" id="deleteModalLabel<?= $s['id'] ?>">Konfirmasi Hapus</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>Apakah Anda yakin ingin menghapus data PAUD <strong><?= esc($s['nama']) ?></strong>?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <a href="/admin/paud/delete/<?= $s['id'] ?>" class="btn btn-danger">Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection() ?>