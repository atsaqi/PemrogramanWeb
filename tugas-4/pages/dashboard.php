<?php 
session_start();
include '../includes/db.php';

// Proteksi Halaman: Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../includes/header.php';

// Ambil data user dari session
$user_id = $_SESSION['user_id'];
$nama_user = $_SESSION['nama'];

// Logika sederhana untuk Progress Bar
// (Menghitung jumlah module yang sudah selesai vs total module)
$total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM modules");
$total_data = mysqli_fetch_assoc($total_query);
$total_modules = $total_data['total'] > 0 ? $total_data['total'] : 1; // Hindari pembagian nol

$done_query = mysqli_query($conn, "SELECT COUNT(*) as selesai FROM progress WHERE user_id = '$user_id' AND is_completed = 1");
$done_data = mysqli_fetch_assoc($done_query);
$done_modules = $done_data['selesai'];

// Hitung persentase
$persentase = ($done_modules / $total_modules) * 100;
?>

<?php if ($persentase >= 100): ?>
    <div class="alert alert-success mt-4 border-0 shadow-sm d-flex align-items-center justify-content-between">
        <div>
            <h5 class="alert-heading fw-bold mb-1">🎉 Selamat, Tugas Selesai!</h5>
            <p class="mb-0 small text-muted">Kamu telah menyelesaikan seluruh materi kursus ini.</p>
        </div>
        <a href="certificate.php" target="_blank" class="btn btn-success fw-bold px-4">
            🎓 Cetak Sertifikat
        </a>
    </div>
<?php else: ?>
    <div class="alert alert-info mt-4 border-0 shadow-sm">
        <small>Selesaikan semua materi (<?php echo $done_modules; ?>/<?php echo $total_modules; ?>) untuk membuka sertifikat.</small>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($nama_user); ?>&background=0056b3&color=fff" class="rounded-circle" width="80">
                    </div>
                    <h5><?php echo $nama_user; ?></h5>
                    <p class="text-muted small">Siswa Web Programming</p>
                    <hr>
                    <div class="text-start">
                        <a href="dashboard.php" class="btn btn-primary w-100 mb-2 text-start">🏠 Dashboard</a>
                        <a href="forum.php" class="btn btn-outline-primary w-100 mb-2 text-start">💬 Forum Diskusi</a>
                        <a href="../index.php#courses" class="btn btn-light w-100 mb-2 text-start">📚 Cari Materi</a>
                        <a href="logout.php" class="btn btn-outline-danger w-100 text-start">🚪 Keluar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <h3 class="fw-bold mb-4">Halo, <?php echo $nama_user; ?>! 👋</h3>
            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Progres Belajar Kamu</h5>
                    <p class="text-muted small">Selesaikan semua materi untuk mendapatkan sertifikat.</p>
                    <div class="progress" style="height: 25px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                             role="progressbar" 
                             style="width: <?php echo $persentase; ?>%;" 
                             aria-valuenow="<?php echo $persentase; ?>" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                             <?php echo round($persentase); ?>%
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="fw-bold mb-3">Materi yang Harus Diselesaikan</h5>
            <div class="row g-3">
                <?php
                $courses = mysqli_query($conn, "SELECT * FROM courses");
                while($c = mysqli_fetch_array($courses)) {
                ?>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <h2 class="me-3"><?php echo $c['icon']; ?></h2>
                            <div>
                                <h6 class="mb-1 fw-bold"><?php echo $c['judul']; ?></h6>
                                <a href="course-detail.php?id=<?php echo $c['id']; ?>" class="btn btn-sm btn-primary">Lanjut Belajar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>