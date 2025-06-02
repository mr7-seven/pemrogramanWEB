<?php
require_once('koneksi.php');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$username = trim($data['username'] ?? '');
$password = $data['password'] ?? '';

if (!$username || !$password) {
    echo json_encode(['status' => false, 'pesan' => 'Username dan password harus diisi']);
    exit;
}

// Cek apakah username sudah dipakai
$stmt = $mysqli->prepare("SELECT id FROM tb_user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['status' => false, 'pesan' => 'Username sudah digunakan']);
    $stmt->close();
    exit;
}
$stmt->close();

// Hash password
$hash = password_hash($password, PASSWORD_DEFAULT);

// Simpan user baru
$stmt = $mysqli->prepare("INSERT INTO tb_user (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hash);

if ($stmt->execute()) {
    echo json_encode(['status' => true]);
} else {
    echo json_encode(['status' => false, 'pesan' => 'Gagal menyimpan data']);
}

$stmt->close();
