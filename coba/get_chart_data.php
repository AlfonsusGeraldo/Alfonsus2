<?php
header('Content-Type: application/json');
include 'koneksi.php';

$query = "SELECT kategori, persentase FROM skills ORDER BY id ASC";
$result = mysqli_query($koneksi, $query);

$labels = [];
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['kategori'];
    $data[]   = (int)$row['persentase'];
}

echo json_encode([
    'labels' => $labels,
    'data'   => $data
]);
?>