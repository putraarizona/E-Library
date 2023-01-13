<?php
include '../config/koneksi.php';

$id_buku = $_POST['id_buku'];

$query = "DELETE FROM buku WHERE id_buku=?";
$buku = $koneksi->prepare($query);
$buku->bind_param("i", $id_buku);
$buku->execute();

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>