<?php 
include '../includes/db.php'; 
include '../includes/header.php'; // Header mungkin perlu penyesuaian path CSS-nya nanti
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <h3 class="text-center fw-bold text-primary mb-4">Daftar Akun</h3>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                        </div>
                        <button type="submit" name="register" class="btn btn-primary w-100">Daftar Sekarang</button>
                    </form>
                    <p class="text-center mt-3 mt-3">Sudah punya akun? <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    // Enkripsi password sesuai spesifikasi (bcrypt)
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO users (nama, email, password, role) VALUES ('$nama', '$email', '$password', 'student')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registrasi Berhasil! Silakan Login'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Gagal Registrasi: " . mysqli_error($conn) . "');</script>";
    }
}
include '../includes/footer.php';
?>