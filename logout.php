<?php
session_start();
session_unset();
session_destroy();
header('Location: login.php'); // Ganti ke nama file halaman login kamu
exit;
