<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include '../config/koneksi.php';

$id_pengembalian = stripslashes(strip_tags(htmlspecialchars($_POST['id_pengembalian'] ,ENT_QUOTES)));
$id_anggota = stripslashes(strip_tags(htmlspecialchars($_POST['id_anggota'] ,ENT_QUOTES)));
$id_petugas = stripslashes(strip_tags(htmlspecialchars($_POST['id_petugas'] ,ENT_QUOTES)));
$id_buku = stripslashes(strip_tags(htmlspecialchars($_POST['id_buku'] ,ENT_QUOTES)));
$denda = stripslashes(strip_tags(htmlspecialchars($_POST['denda'] ,ENT_QUOTES)));
$tanggal_pengembalian = date_format(date_create($_POST['tanggal_pengembalian']), "Y-m-d");

if ($id_pengembalian == "") {
	$query = "INSERT into pengembalian (id_anggota, id_petugas, id_buku, denda, tanggal_pengembalian) VALUES (?, ?, ?, ?, ?)";
	$pengembalian = $koneksi->prepare($query);
	$pengembalian->bind_param("sssss", $id_anggota, $id_petugas, $id_buku, $denda, $tanggal_pengembalian);
	$pengembalian->execute();

	$query_stok_buku = "SELECT * from buku WHERE id_buku=?";
	$q_stok_buku = $koneksi->prepare($query_stok_buku);
	$q_stok_buku->bind_param("i", $id_buku);
	$q_stok_buku->execute();
	$result = $q_stok_buku->get_result()->fetch_assoc();
	$stok_buku = $result['stok'] + 1;

	$query_update_stok_buku = "UPDATE buku SET stok=? WHERE id_buku=?";
	$update_stok_buku = $koneksi->prepare($query_update_stok_buku);
	$update_stok_buku->bind_param("ii", $stok_buku, $id_buku);
	$update_stok_buku->execute();

} else {
	$query = "UPDATE pengembalian SET id_anggota=?, id_petugas=?, id_buku=?, denda=?, tanggal_pengembalian=? WHERE id_pengembalian=?";
	$pengembalian = $koneksi->prepare($query);
	$pengembalian->bind_param("iiissi", $id_anggota, $id_petugas, $id_buku, $denda, $tanggal_pengembalian, $id_pengembalian);
	$pengembalian->execute();
}

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>