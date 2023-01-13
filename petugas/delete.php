<?php
include '../config/koneksi.php';

$id_petugas = $_POST['id_petugas'];

$query = "DELETE FROM petugas WHERE id_petugas=?";
$petugas = $koneksi->prepare($query);
$petugas->bind_param("i", $id_petugas);
$petugas->execute();

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>