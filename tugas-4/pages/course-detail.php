<?php 
session_start();
include '../includes/db.php';

// Proteksi halaman
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../includes/header.php';

$user_id = $_SESSION['user_id'];
$course_id = $_GET['id'] ?? 1; // Mengambil ID dari URL

// Ambil data course
$course_query = mysqli_query($conn, "SELECT * FROM courses WHERE id = '$course_id'");
$course = mysqli_fetch_assoc($course_query);

// Ambil semua bab (modules) untuk course ini
$modules_query = mysqli_query($conn, "SELECT * FROM modules WHERE course_id = '$course_id'");
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white fw-bold">
                    Daftar Bab: <?php echo $course['judul']; ?>
                </div>
                <div class="list-group list-group-flush">
                    <?php 
                    $first_module_id = null;
                    while($m = mysqli_fetch_assoc($modules_query)) { 
                        if(!$first_module_id) $first_module_id = $m['id'];
                    ?>
                        <a href="?id=<?php echo $course_id; ?>&mod=<?php echo $m['id']; ?>" 
                           class="list-group-item list-group-item-action">
                           📄 <?php echo $m['judul_bab']; ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <a href="dashboard.php" class="btn btn-outline-secondary w-100 mt-3">⬅ Kembali ke Dashboard</a>
        </div>

        <div class="col-md-8">
            <?php
            // Ambil detail bab yang dipilih (default ke bab pertama)
            $mod_id = $_GET['mod'] ?? $first_module_id;
            $content_query = mysqli_query($conn, "SELECT * FROM modules WHERE id = '$mod_id'");
            $content = mysqli_fetch_assoc($content_query);

            if ($content) {
            ?>
                <div class="card border-0 shadow-sm p-4">
                    <h2 class="fw-bold text-primary"><?php echo $content['judul_bab']; ?></h2>
                    <hr>
                    
                    <div class="p-5 mb-4 bg-light rounded-3 border-start border-primary border-5 shadow-sm">
                        <div class="container-fluid py-2">
                            <h1 class="display-6 fw-bold text-primary">Modul Pembelajaran</h1>
                            <p class="col-md-8 fs-5 text-muted">Silakan baca materi di bawah ini dengan teliti. Klik tombol selesai jika sudah paham.</p>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm p-4 mb-4">
                        <div class="materi-text" style="line-height: 1.8; font-size: 1.1rem;">
                            <?php echo nl2br($content['konten']); ?>
                        </div>
                    </div>

                    <div class="materi-text mb-4">
                        <?php echo nl2br($content['konten']); ?>
                    </div>

                    <form action="" method="POST">
                        <input type="hidden" name="module_id" value="<?php echo $mod_id; ?>">
                        <button type="submit" name="complete" class="btn btn-success btn-lg w-100">
                            ✅ Tandai Sudah Selesai
                        </button>
                    </form>
                </div>
            <?php 
            } else {
                echo "<div class='alert alert-info'>Pilih materi untuk mulai belajar.</div>";
            } 
            ?>
        </div>
    </div>
</div>

<?php
// Logika simpan progress
if (isset($_POST['complete'])) {
    $m_id = $_POST['module_id'];
    
    // Cek apakah sudah pernah diselesaikan sebelumnya
    $cek = mysqli_query($conn, "SELECT * FROM progress WHERE user_id = '$user_id' AND module_id = '$m_id'");
    
    if (mysqli_num_rows($cek) == 0) {
        $insert = mysqli_query($conn, "INSERT INTO progress (user_id, module_id, is_completed) VALUES ('$user_id', '$m_id', 1)");
        if ($insert) {
            echo "<script>alert('Selamat! Progres bertambah.'); window.location.href='dashboard.php';</script>";
        }
    } else {
        echo "<script>alert('Materi ini sudah pernah kamu selesaikan!');</script>";
    }
}

include '../includes/footer.php';
?>