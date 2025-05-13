<?= $this->include('components/header') ?>

<div class="d-flex">
  <!-- Sidebar -->
  <?= $this->include('components/sidebar') ?>

  <!-- Main Content -->
  <main class="flex-grow-1 p-4" style="margin-left:250px; min-height: 100vh; background-color: #f5f5f5;">
    <?= $this->renderSection('content') ?>
  </main>
</div>

<?= $this->include('components/footer') ?>
