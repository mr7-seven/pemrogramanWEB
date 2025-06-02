<?php
session_start();
require_once('koneksi.php');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$username = $data['username'] ?? null;
$password = $data['password'] ?? null;

if (!$username || !$password) {
    echo json_encode(['status' => false, 'pesan' => 'Username atau password kosong']);
    exit;
}

// Cek di database
$stmt = $mysqli->prepare("SELECT id, username, password FROM tb_user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    // Bandingkan password (dengan password_hash jika pakai hashing)
    if (password_verify($password, $user['password'])) {
        // Login berhasil, bisa set session jika ingin
        // Simpan session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        echo json_encode([
            'status' => true,
            'user_id' => $user['id'],
            'username' => $user['username']
        ]);
    } else {
        echo json_encode(['status' => false, 'pesan' => 'Password salah']);
    }
} else {
    echo json_encode(['status' => false, 'pesan' => 'Username tidak ditemukan']);
}

$stmt->close();
?>
