<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'includes/db.php';
include 'includes/header.php';
?>

<section class="bg-primary text-white py-5">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold">Kuasai Web Programming dari Nol</h1>
        <p class="lead mb-4">Belajar HTML, CSS, JavaScript, dan PHP secara terstruktur dan interaktif.</p>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="pages/dashboard.php" class="btn btn-light btn-lg px-5 fw-bold text-primary">Lanjut Belajar Kamu</a>
        <?php else: ?>
            <a href="pages/register.php" class="btn btn-light btn-lg px-5 fw-bold text-primary">Mulai Belajar Sekarang</a>
        <?php endif; ?>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <h5>Flexible Learning</h5>
                <p>Belajar kapan saja dan di mana saja.</p>
            </div>
            <div class="col-md-4">
                <h5>Sertifikat Resmi</h5>
                <p>Dapatkan sertifikat setelah lulus ujian.</p>
            </div>
            <div class="col-md-4">
                <h5>Materi Ter-update</h5>
                <p>Kurikulum sesuai kebutuhan industri.</p>
            </div>
        </div>
    </div>
</section>

<section id="courses" class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Materi yang Akan Kamu Pelajari</h2>
        <div class="row g-4">
            <?php
            // Ambil data dari database
            $query = mysqli_query($conn, "SELECT * FROM courses");
            while($data = mysqli_fetch_array($query)) {
            ?>
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm text-center p-3">
                    <div class="card-body">
                        <h3 class="h1"><?php echo $data['icon']; ?></h3>
                        <h5 class="card-title fw-bold"><?php echo $data['judul']; ?></h5>
                        <p class="card-text small text-muted"><?php echo $data['deskripsi']; ?></p>
                        <a href="pages/course-detail.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-outline-primary">Pelajari</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>