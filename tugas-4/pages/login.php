<?php 
session_start(); // Memulai session
include '../includes/db.php'; 
include '../includes/header.php'; 

// Jika user sudah login, arahkan langsung ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <h3 class="text-center fw-bold text-primary mb-4">Login</h3>
                    
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100">Masuk</button>
                    </form>
                    
                    <p class="text-center mt-3">Belum punya akun? <a href="register.php">Daftar</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    
    if (mysqli_num_rows($query) === 1) {
        $user = mysqli_fetch_assoc($query);
        
        // Verifikasi password hash (Bcrypt)
        if (password_verify($password, $user['password'])) {
            // Set data ke dalam session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama']    = $user['nama'];
            $_SESSION['role']    = $user['role'];

            echo "<script>alert('Selamat Datang, " . $user['nama'] . "!'); window.location='dashboard.php';</script>";
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Email tidak terdaftar!');</script>";
    }
}
include '../includes/footer.php';
?>