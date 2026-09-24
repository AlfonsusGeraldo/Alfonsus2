<?php
header('Content-Type: application/json');
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $pesan = isset($_POST['pesan']) ? trim($_POST['pesan']) : '';

    if (!empty($nama) && !empty($email) && !empty($pesan)) {
        // Mencegah SQL Injection dengan Prepared Statement
        $stmt = mysqli_prepare($koneksi, "INSERT INTO pesan (nama, email, pesan) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $nama, $email, $pesan);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['status' => 'success', 'message' => 'Pesan kamu berhasil terkirim!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan pesan ke database.']);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Semua kolom wajib diisi.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Akses tidak diizinkan.']);
}
?>