<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebLearn - Kursus Pemrograman Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary-blue: #0056b3; }
        .bg-primary { background-color: var(--primary-blue) !important; }
        .text-primary { color: var(--primary-blue) !important; }
        .btn-primary { background-color: var(--primary-blue); border: none; }
        .materi-text b { color: #0056b3; display: block; margin-top: 20px; }
        .materi-text { color: #333; }
    </style>
</head>
<body>

<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="/tugas-4/index.php">WEBLEARN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/tugas-4/index.php">Home</a></li>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="/tugas-4/index.php#courses">Course</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tugas-4/pages/forum.php">Forum</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tugas-4/pages/dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="btn btn-danger ms-lg-3" href="/tugas-4/pages/logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/tugas-4/pages/login.php">Login</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-lg-3" href="/tugas-4/pages/register.php">Daftar Sekarang</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>