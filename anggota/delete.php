<?php
include '../config/koneksi.php';

$id_anggota = $_POST['id_anggota'];

$query = "DELETE FROM anggota WHERE id_anggota=?";
$anggota = $koneksi->prepare($query);
$anggota->bind_param("i", $id_anggota);
$anggota->execute();

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>