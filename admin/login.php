<?php
session_start();
include '../config/database.php';

if (isset($_SESSION['id_admin'])) {
    $message = 'already_logged_in';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $koneksi->prepare("SELECT id_admin, username, password FROM tb_admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['id_admin'] = $admin['id_admin'];
            $_SESSION['username'] = $admin['username'];
            $message = 'success';
        } else {
            $message = "Username atau password salah!";
        }
    } else {
        $message = "Username atau password salah!";
    }

    header('Content-Type: application/json');
    echo json_encode(['message' => $message]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SIPADU BPBD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-light) 100%);
            padding: 20px;
        }
        
        .login-card {
            width: 100%;
            max-width: 420px;
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 40px;
            text-align: center;
        }
        
        .login-header .logo-icon {
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }
        
        .login-header h1 {
            color: var(--white);
            font-size: 1.5rem;
            margin-bottom: 5px;
        }
        
        .login-header p {
            color: var(--primary-lighter);
            font-size: 0.875rem;
        }
        
        .login-body {
            padding: 40px;
        }
        
        .login-footer {
            padding: 20px 40px;
            background: var(--gray-50);
            text-align: center;
            font-size: 0.875rem;
            color: var(--gray-600);
        }
    </style>
</head>
<body>
    <div class="login-page">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-icon">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <h1>SIPADU BPBD</h1>
                <p>Sistem Pendataan Bencana Terpadu</p>
            </div>
            
            <div class="login-body">
                <h3 style="text-align: center; margin-bottom: 30px;">Login Administrator</h3>
                
                <div id="alert-container"></div>
                
                <form id="form-login" data-validate>
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <div style="position: relative;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--gray-400)" stroke-width="2" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%);">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <input type="text" name="username" class="form-control" style="padding-left: 45px;" placeholder="Masukkan username" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div style="position: relative;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--gray-400)" stroke-width="2" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%);">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input type="password" name="password" class="form-control" style="padding-left: 45px;" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    
                    <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="remember">
                            <span style="font-size: 0.875rem;">Ingat saya</span>
                        </label>
                        <a href="reset_password.php" style="font-size: 0.875rem; color: var(--primary);">Lupa password?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top: 20px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3"/>
                        </svg>
                        Masuk
                    </button>
                </form>
            </div>
            
            <div class="login-footer">
                <a href="../index.php" style="color: var(--primary);">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>
    <script>
   document.getElementById('form-login').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);

    fetch('', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.message === 'success') {
            window.location.href = 'dashboard.php'; 
        } else if (data.message === 'already_logged_in') {
            window.location.href = 'dashboard.php';
        } else {
            showAlert('danger', data.message, '#alert-container');
        }
    })
    .catch(err => console.error(err));
});
    </script>
</body>
</html>
