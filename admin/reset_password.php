<?php
session_start();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $newPassword = $_POST['password'] ?? '';

    $stmt = $koneksi->prepare("SELECT id_admin FROM tb_admin WHERE reset_token = ? AND reset_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt2 = $koneksi->prepare("UPDATE tb_admin SET password = ?, reset_token = NULL, reset_expiry = NULL WHERE id_admin = ?");
        $stmt2->bind_param("si", $hashed, $admin['id_admin']);
        $stmt2->execute();

        echo json_encode(['message' => 'Password berhasil diubah']);
    } else {
        echo json_encode(['message' => 'Token invalid atau sudah kadaluarsa']);
    }
    exit;
}

$token = $_GET['token'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Reset Password</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
<style>
.reset-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-light) 100%);
    padding: 20px;
}

.reset-card {
    width: 100%;
    max-width: 450px;
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
}

.reset-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: var(--white);
    padding: 35px;
    text-align: center;
}

.reset-header .logo-icon {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
}

.reset-header h1 {
    font-size: 1.5rem;
    margin-bottom: 5px;
}

.reset-header p {
    color: var(--primary-lighter);
    font-size: 0.875rem;
}

.reset-body {
    padding: 35px;
}

.reset-body h3 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 1.25rem;
}

.reset-body .form-group {
    margin-bottom: 20px;
}

.reset-body .form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--gray-700);
}

.reset-body .form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid var(--gray-300);
    border-radius: var(--radius);
    font-size: 1rem;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: var(--white);
}

.reset-body .form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(234,88,12,0.15);
}

.reset-body .form-control::placeholder {
    color: var(--gray-400);
}

.reset-body .btn-reset {
    margin-top: 20px;
    width: 100%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    background: var(--primary);
    color: var(--white);
    font-weight: 600;
    font-size: 1rem;
    padding: 12px;
    border-radius: var(--radius);
    border: none;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
}

.reset-body .btn-reset:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
}

.reset-footer {
    padding: 20px 35px;
    background: var(--gray-50);
    text-align: center;
    font-size: 0.875rem;
}

.reset-footer a {
    color: var(--primary);
}

.reset-footer a:hover {
    text-decoration: underline;
}

.popup {
    position: fixed;
    top: 20px;
    right: 20px;
    background: var(--success);
    color: var(--white);
    padding: 15px 20px;
    border-radius: var(--radius);
    box-shadow: var(--shadow-lg);
    display: none;
    z-index: 9999;
    font-weight: 600;
}

.popup.show {
    display: block;
    animation: slideIn 0.4s ease forwards;
}

@keyframes slideIn {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.popup.error {
    background: var(--danger);
}
</style>
</head>
<body>
<div class="reset-page">
  <div class="reset-card">
    <div class="reset-header">
      <div class="logo-icon">🔒</div>
      <h1>SIPADU BPBD</h1>
      <p>Reset Password Administrator</p>
    </div>
    <div class="reset-body">
      <h3>Masukkan Data Akun</h3>
      <form id="form-reset">
        <div class="form-group">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
        </div>
        <div class="form-group">
          <label class="form-label">Password Baru</label>
          <input type="password" name="password" class="form-control" placeholder="Password baru" required>
        </div>
        <div class="form-group">
          <label class="form-label">Konfirmasi Password</label>
          <input type="password" name="password_confirm" class="form-control" placeholder="Ulangi password" required>
        </div>
        <button type="submit" class="btn-reset">Reset Password</button>
      </form>
    </div>
    <div class="reset-footer">
      <a href="login.php">← Kembali ke Login</a>
    </div>
  </div>
</div>

<div id="popup" class="popup"></div>

<script>
document.getElementById('form-reset').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const username = form.username.value.trim();
    const password = form.password.value.trim();
    const passwordConfirm = form.password_confirm.value.trim();

    if (!username || !password || !passwordConfirm) {
        showPopup('Semua field wajib diisi!', true);
        return;
    }

    if (password !== passwordConfirm) {
        showPopup('Password dan konfirmasi password tidak cocok!', true);
        return;
    }

    const formData = new FormData(form);
    fetch('reset_password_action.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showPopup(data.message, false);
            form.reset();
            setTimeout(() => window.location.href = 'login.php', 3000);
        } else {
            showPopup(data.message, true);
        }
    })
    .catch(err => {
        console.error(err);
        showPopup('Terjadi kesalahan server!', true);
    });
});

function showPopup(message, isError = false) {
    const popup = document.getElementById('popup');
    popup.textContent = message;
    popup.className = 'popup show';
    if (isError) popup.classList.add('error');

    setTimeout(() => {
        popup.classList.remove('show', 'error');
    }, 3000);
}
</script>
</body>
</html>
