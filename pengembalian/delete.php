<?php
include '../config/koneksi.php';

$id_pengembalian = $_POST['id_pengembalian'];

$query = "DELETE FROM pengembalian WHERE id_pengembalian=?";
$pengembalian = $koneksi->prepare($query);
$pengembalian->bind_param("i", $id_pengembalian);
$pengembalian->execute();

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>