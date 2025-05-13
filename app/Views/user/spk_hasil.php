<?= $this->extend('layouts/user') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
  <h2 class="fw-bold text-success mb-4">Hasil Rekomendasi PAUD</h2>

  <div class="alert alert-info" role="alert">
    Skor menunjukkan tingkat kesesuaian PAUD dengan preferensi Anda berdasarkan kriteria yang telah dipilih.
    Semakin tinggi skor, semakin sesuai PAUD tersebut dengan prioritas Anda.
  </div>

  <div class="table-responsive">
    <table class="table table-bordered align-middle">
      <thead class="table-success text-center">
        <tr>
          <th>Peringkat</th>
          <th>Nama PAUD</th>
          <th>Skor</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; foreach ($hasil as $h): ?>
          <tr>
            <td class="text-center fw-bold"><?= $no++ ?></td>
            <td><?= esc($h['nama']) ?></td>
            <td class="text-center"><?= number_format($h['skor'], 2) ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <div class="alert alert-success" role="alert">
  Berdasarkan prioritas kriteria yang Anda tetapkan, <strong><?= esc($hasil[0]['nama']) ?></strong> merupakan PAUD yang paling sesuai dengan kebutuhan Anda, dengan skor tertinggi sebesar <strong><?= number_format($hasil[0]['skor'], 2) ?></strong>.
</div>
  <div class="mt-5">
    <h5 class="fw-bold text-secondary">Kriteria dan Bobot Anda</h5>
    <p class="text-muted small">
      <span class="text-secondary">
        Berikut adalah kriteria yang Anda pilih beserta bobotnya, yang mencerminkan tingkat prioritas masing-masing.
      </span>
    </p>
    <ul class="list-group">
      <?php foreach ($kriteria as $k): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>
            <?= esc($k['nama']) ?> <small class="text-muted">(<?= esc($k['jenis']) ?>)</small>
          </span>
          <span class="badge bg-success rounded-pill">Bobot: <?= esc($bobot[$k['id']]) ?></span>
        </li>
      <?php endforeach ?>
    </ul>
  </div>

  <div class="mt-5">
  <h5 class="fw-bold text-secondary">Visualisasi Skor PAUD</h5>
  <canvas id="grafikSkor" height="100"></canvas>
</div>


  <a href="/spk" class="btn btn-outline-secondary mt-4">Coba Ulang</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('grafikSkor').getContext('2d');
  const grafikSkor = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode(array_column($hasil, 'nama')) ?>,
      datasets: [{
        labels: <?= json_encode(array_column($hasil, 'nama')) ?>,
data: <?= json_encode(array_column($hasil, 'skor_normal')) ?>,
backgroundColor: <?= json_encode(array_map(fn($s) =>
  $s >= 0.75 ? 'rgba(0, 200, 83, 0.8)' :
  ($s >= 0.5 ? 'rgba(76, 175, 80, 0.8)' :
  'rgba(139, 195, 74, 0.8)'), array_column($hasil, 'skor_normal'))
) ?>,
        borderColor: 'rgba(40, 167, 69, 1)',
        borderWidth: 1,
        borderRadius: 5
      }]
    },
    options: {
      indexAxis: 'y',
      scales: {
        x: {
          beginAtZero: true,
          max: 1
        }
      },
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              return 'Skor: ' + context.raw.toFixed(4);
            }
          }
        }
      }
    }
  });
</script>
<?= $this->endSection() ?>
