<style>
  * {
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  body {
    background: linear-gradient(135deg, #3f87a6, #ebf8e1);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
  }

  .login-container {
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
    position: relative;
  }

  .logo {
    width: 80px;
    margin-bottom: 20px;
  }

  h2 {
    margin-bottom: 10px;
    color: #333;
  }

  .description {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
  }

  .form-group {
    margin-bottom: 20px;
    text-align: left;
  }

  label {
    display: block;
    margin-bottom: 6px;
    color: #444;
  }

  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    transition: border-color 0.3s;
  }

  input[type="text"]:focus,
  input[type="password"]:focus {
    border-color: #3f87a6;
    outline: none;
  }

  .btn-login {
    background-color: #3f87a6;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
  }

  .btn-login:hover {
    background-color: #336b8a;
  }

  .error-message {
    color: red;
    margin-bottom: 15px;
  }

  .help-link {
    margin-top: 15px;
    font-size: 13px;
    color: #3f87a6;
    text-decoration: none;
    display: inline-block;
  }

  .help-link:hover {
    text-decoration: underline;
  }

  .footer {
    margin-top: 30px;
    font-size: 12px;
    color: #aaa;
  }

  @media (max-width: 480px) {
    .login-container {
      padding: 20px;
    }
  }
</style>

<div class="login-container">
  <h2>Selamat Datang di Admin SPK PAUD</h2>

  <p class="description">Sistem Pendukung Keputusan untuk memilih PAUD terbaik berdasarkan kriteria terpercaya.</p>

  <?php if (session()->getFlashdata('error')): ?>
    <p class="error-message"><?= session()->getFlashdata('error') ?></p>
  <?php endif; ?>

  <form method="post" action="/login">
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" required>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>
    </div>

    <button type="submit" class="btn-login">Login</button>
  </form>


  <!-- Footer -->
  <div class="footer">
    © 2025 SPK PAUD. All rights reserved.<br>
    Versi 1.0.0
  </div>
</div>
