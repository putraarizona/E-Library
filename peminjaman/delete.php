<?php
include '../config/koneksi.php';

$id_peminjaman = $_POST['id_peminjaman'];

$query = "DELETE FROM peminjaman WHERE id_peminjaman=?";
$peminjaman = $koneksi->prepare($query);
$peminjaman->bind_param("i", $id_peminjaman);
$peminjaman->execute();

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>