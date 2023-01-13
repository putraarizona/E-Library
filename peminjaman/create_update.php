<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include '../config/koneksi.php';

$id_peminjaman = stripslashes(strip_tags(htmlspecialchars($_POST['id_peminjaman'] ,ENT_QUOTES)));
$id_anggota = stripslashes(strip_tags(htmlspecialchars($_POST['id_anggota'] ,ENT_QUOTES)));
$id_petugas = stripslashes(strip_tags(htmlspecialchars($_POST['id_petugas'] ,ENT_QUOTES)));
$id_buku = stripslashes(strip_tags(htmlspecialchars($_POST['id_buku'] ,ENT_QUOTES)));
$tanggal_pinjam = date_format(date_create($_POST['tanggal_pinjam']), "Y-m-d");
$tanggal_kembali = date_format(date_create($_POST['tanggal_kembali']), "Y-m-d");

if ($id_peminjaman == "") {
	$query = "INSERT into peminjaman (id_anggota, id_petugas, id_buku, tanggal_pinjam, tanggal_kembali) VALUES (?, ?, ?, ?, ?)";
	$peminjaman = $koneksi->prepare($query);
	$peminjaman->bind_param("sssss", $id_anggota, $id_petugas, $id_buku, $tanggal_pinjam, $tanggal_kembali);
	$peminjaman->execute();

	$query_stok_buku = "SELECT * from buku WHERE id_buku=?";
	$q_stok_buku = $koneksi->prepare($query_stok_buku);
	$q_stok_buku->bind_param("i", $id_buku);
	$q_stok_buku->execute();
	$result = $q_stok_buku->get_result()->fetch_assoc();
	$stok_buku = $result['stok'] - 1;

	$query_update_stok_buku = "UPDATE buku SET stok=? WHERE id_buku=?";
	$update_stok_buku = $koneksi->prepare($query_update_stok_buku);
	$update_stok_buku->bind_param("ii", $stok_buku, $id_buku);
	$update_stok_buku->execute();

} else {
	$query = "UPDATE peminjaman SET id_anggota=?, id_petugas=?, id_buku=?, tanggal_pinjam=?, tanggal_kembali=? WHERE id_peminjaman=?";
	$peminjaman = $koneksi->prepare($query);
	$peminjaman->bind_param("iiissi", $id_anggota, $id_petugas, $id_buku, $tanggal_pinjam, $tanggal_kembali, $id_peminjaman);
	$peminjaman->execute();
}

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>