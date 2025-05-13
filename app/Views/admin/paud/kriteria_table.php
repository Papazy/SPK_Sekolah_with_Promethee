<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
  <div class="card shadow-sm rounded-4">
    <div class="card-body p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="fw-bold text-success mb-3">Tabel Kriteria PAUD</h3>
  <button class="btn btn-outline-success" id="editModeBtn">
    <i class="bi bi-pencil-square"></i> Edit Mode
  </button>
</div>
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle" id="tabelKriteria">
          <thead class="table-success text-center">
            <tr>
              <th>Nama PAUD</th>
                <?php foreach ($kriteria as $k): ?>
      
                  <th class="text-center"><?= 'C'.$k['id'] ?></th>
     
                <?php endforeach; ?>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($paud as $p): ?>
                <tr>
                <td><?= esc($p['nama']) ?></td>
                <?php foreach ($kriteria as $k): ?>

                    <td class="text-center editable-cell" 
                      contenteditable="false"
                      data-paud="<?= $p['id'] ?>"
                      data-kriteria="<?= $k['id'] ?>">
                      <?= number_format((int)esc($p['C'.$k['id']]), 0, '', '') ?>
                    </td>

                <?php endforeach; ?>
                </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
        <div class="text-end mt-3">
  <button class="btn btn-success" id="saveAllBtn">
    <i class="bi bi-save"></i> Simpan Semua
  </button>
</div>
      </div>
    </div>
  </div>
</div>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function () {
    $('#tabelKriteria').DataTable({
      responsive: true,
      ordering: true,
      paging: false
    });
  });
</script>

<script>
  let editMode = false;

  $('#editModeBtn').on('click', function () {
    editMode = !editMode;
    $('.editable-cell').attr('contenteditable', editMode);

    if (editMode) {
      $(this).removeClass('btn-outline-primary').addClass('btn-outline-danger')
             .html('<i class="bi bi-x-lg"></i> Batal Edit');
    } else {
      $(this).removeClass('btn-outline-danger').addClass('btn-outline-primary')
             .html('<i class="bi bi-pencil-square"></i> Edit Mode');
    }
  });

  $('.editable-cell').on('blur', function () {
    if (!editMode) return;

    const cell = $(this);
    const paudId = cell.data('paud');
    const kriteriaId = cell.data('kriteria');
    const nilai = cell.text();

    // Kirim AJAX
    $.ajax({
      url: '/admin/paud/update-kriteria',
      method: 'POST',
      data: {
        paud_id: paudId,
        kriteria_id: kriteriaId,
        nilai: nilai,
      },
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': '<?= csrf_hash() ?>' // jika pakai CSRF
      },
      success: function (res) {
        console.log('Berhasil simpan');
      },
      error: function (err) {
        console.error('Gagal simpan nilai', err);
      }
    });
  });
</script>

<script>
  $('#saveAllBtn').on('click', function () {
    let data = [];

    $('.editable-cell').each(function () {
      const cell = $(this);
      const paudId = cell.data('paud');
      const kriteriaId = cell.data('kriteria');
      const nilai = cell.text().trim();

      if (nilai !== '') {
        data.push({
          paud_id: paudId,
          kriteria_id: kriteriaId,
          nilai: nilai
        });
      }
    });

    // Kirim semua data via AJAX
    $.ajax({
      url: '/admin/paud/update-kriteria-massal',
      method: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({ data: data }),
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
      },
      success: function (res) {
        alert('✅ Semua nilai berhasil disimpan!');
      },
      error: function (err) {
        console.error(err);
        alert('❌ Gagal menyimpan data!');
      }
    });
  });
</script>


<?= $this->endSection() ?>
