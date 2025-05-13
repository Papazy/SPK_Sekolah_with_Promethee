<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>


<div class="content" style="padding: 30px;">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard Utama</h2>
    <div>
      <select class="form-select form-select-sm">
        <option>2025</option>
        <option>2024</option>
      </select>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-md-3">
      <div class="card shadow-sm border-0 text-center">
        <div class="card-body">
          <div class="text-muted">Total PAUD</div>
          <div class="fs-2 fw-bold"><?= $totalPaud ?></div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-0 text-center">
        <div class="card-body">
          <div class="text-muted">Jumlah Kriteria</div>
          <div class="fs-2 fw-bold text-primary"><?= $jumlahKriteria ?></div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm border-0 text-center">
        <div class="card-body">
          <div class="text-muted">PAUD Terverifikasi Kriteria</div>
          <div class="fs-2 fw-bold text-success"><?= $terverifikasi ?></div>
        </div>
      </div>
    </div>
   
   
  </div>

  <div class="row g-4 mt-4">
    <div class="col-md-7">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title">Grafik Perkembangan PAUD</h5>
          <canvas id="chartPaudLine"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title">Distribusi Kecamatan</h5>
          <canvas id="chartPie"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const lineChart = new Chart(document.getElementById('chartPaudLine'), {
  type: 'line',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
    datasets: [{
      label: 'PAUD Terverifikasi',
      data: [20, 25, 40, 50, 60],
      fill: true,
      backgroundColor: 'rgba(75, 192, 192, 0.2)',
      borderColor: 'rgb(75, 192, 192)',
      tension: 0.4
    }]
  }
});

const pieChart = new Chart(document.getElementById('chartPie'), {
  type: 'doughnut',
  data: {
    labels: <?= json_encode(array_column($kecamatanData, 'kecamatan')) ?>,
    datasets: [{
      label: 'Distribusi PAUD',
      data: <?= json_encode(array_column($kecamatanData, 'total')) ?>,
      backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1', '#fd7e14', '#20c997', '#6610f2']
    }]
  }
});
</script>
<?= $this->endSection()?>