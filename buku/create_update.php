<?php
include '../config/koneksi.php';

$id_buku = stripslashes(strip_tags(htmlspecialchars($_POST['id_buku'] ,ENT_QUOTES)));
$kode_buku = stripslashes(strip_tags(htmlspecialchars($_POST['kode_buku'] ,ENT_QUOTES)));
$judul_buku = stripslashes(strip_tags(htmlspecialchars($_POST['judul_buku'] ,ENT_QUOTES)));
$penulis_buku = stripslashes(strip_tags(htmlspecialchars($_POST['penulis_buku'] ,ENT_QUOTES)));
$penerbit_buku = stripslashes(strip_tags(htmlspecialchars($_POST['penerbit_buku'] ,ENT_QUOTES)));
$tahun_terbit = stripslashes(strip_tags(htmlspecialchars($_POST['tahun_terbit'] ,ENT_QUOTES)));
$stok = stripslashes(strip_tags(htmlspecialchars($_POST['stok'] ,ENT_QUOTES)));

if ($id_buku == "") {
	$query = "INSERT into buku (kode_buku, judul_buku, penulis_buku, penerbit_buku, tahun_terbit, stok) VALUES (?, ?, ?, ?, ?, ?)";
	$buku = $koneksi->prepare($query);
	$buku->bind_param("ssssss", $kode_buku, $judul_buku, $penulis_buku, $penerbit_buku, $tahun_terbit, $stok);
	$buku->execute();
} else {
	$query = "UPDATE buku SET kode_buku=?, judul_buku=?, penulis_buku=?, penerbit_buku=?, tahun_terbit=?, stok=? WHERE id_buku=?";
	$buku = $koneksi->prepare($query);
	$buku->bind_param("ssssssi", $kode_buku, $judul_buku, $penulis_buku, $penerbit_buku, $tahun_terbit, $stok, $id_buku);
	$buku->execute();
}

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>