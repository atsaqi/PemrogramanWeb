<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include '../includes/header.php';

// Simpan pesan jika ada post
if (isset($_POST['kirim'])) {
    $uid = $_SESSION['user_id'];
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);
    mysqli_query($conn, "INSERT INTO forum (user_id, pesan) VALUES ('$uid', '$pesan')");
}

// Ambil pesan forum
$query = mysqli_query($conn, "SELECT forum.*, users.nama FROM forum JOIN users ON forum.user_id = users.id ORDER BY created_at DESC");
?>

<div class="container mt-5">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Forum Diskusi</li>
      </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="fw-bold mb-4">💬 Forum Diskusi Siswa</h4>
                    
                    <form action="" method="POST" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="pesan" class="form-control" placeholder="Tanya sesuatu..." required>
                            <button name="kirim" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>

                    <div class="chat-box" style="height: 400px; overflow-y: auto;">
                        <?php while($f = mysqli_fetch_assoc($query)) { ?>
                            <div class="mb-3 p-3 bg-light rounded shadow-sm">
                                <div class="d-flex justify-content-between">
                                    <strong class="text-primary"><?php echo $f['nama']; ?></strong>
                                    <small class="text-muted"><?php echo $f['created_at']; ?></small>
                                </div>
                                <p class="mb-0 mt-1"><?php echo $f['pesan']; ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>