<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html'); // redirect ke halaman login jika belum login
    exit;
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body text-center">
            <h3 class="mb-3">Selamat Datang</h3>
            <p class="fs-5">Session User ID Anda: <strong><?php echo htmlspecialchars($user_id); ?></strong></p>
            <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
        </div>
    </div>
</div>

</body>
</html>
