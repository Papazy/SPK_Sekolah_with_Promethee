<div class="sidebar text-white fixed-top d-flex flex-column" style="width:250px; height:100vh; background-color: #388e3c;">
  <div class="p-4 fs-4 fw-bold border-bottom border-white">SPK PAUD</div>
  <ul class="nav flex-column pt-3">
    <li class="nav-item">
      <a class="nav-link text-white <?= uri_string() === 'admin' ? 'active bg-success' : '' ?>" href="/admin/dashboard">
        <i class="bi bi-speedometer2"></i> Dashboard
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" data-bs-toggle="collapse" href="#paudSub" role="button" aria-expanded="false">
        <i class="bi bi-building"></i> Data PAUD <i class="bi bi-chevron-down float-end"></i>
      </a>
      <div class="collapse ps-3" id="paudSub">
        <a href="/admin/paud" class="nav-link text-white">Daftar PAUD</a>
        <a href="/admin/paud/kriteria" class="nav-link text-white">Kriteria PAUD</a>
      </div>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link text-white" data-bs-toggle="collapse" href="#kriteriaSub" role="button" aria-expanded="false">
      <i class="bi bi-clipboard-minus-fill"></i> Data Kriteria <i class="bi bi-chevron-down float-end"></i>
      </a>
      <div class="collapse ps-3" id="kriteriaSub">
        <a href="/admin/kriteria" class="nav-link text-white">Daftar Kriteria</a>
      </div>
    </li> -->
    <!-- <li class="nav-item">
      <a class="nav-link text-white" href="/paud/create">
        <i class="bi bi-bar-chart-line"></i> Laporan
      </a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link text-white <?= uri_string() === 'admin/kriteria' ? 'active bg-success' : '' ?>" href="/admin/kriteria">
        <i class="bi bi-speedometer2"></i> Kriteria
      </a>
    </li>
    <li class="nav-item mt-auto p-3">
      <form action="/logout" method="post">
      <button type="submit" class="btn btn-outline-light w-100">Logout</button>
      </form>
    </li>
  </ul>
</div>
