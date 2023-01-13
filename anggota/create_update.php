<?php
include '../config/koneksi.php';

$id_anggota = stripslashes(strip_tags(htmlspecialchars($_POST['id_anggota'] ,ENT_QUOTES)));
$kode_anggota = stripslashes(strip_tags(htmlspecialchars($_POST['kode_anggota'] ,ENT_QUOTES)));
$nama_anggota = stripslashes(strip_tags(htmlspecialchars($_POST['nama_anggota'] ,ENT_QUOTES)));
$jk_anggota = stripslashes(strip_tags(htmlspecialchars($_POST['jk_anggota'] ,ENT_QUOTES)));
$jurusan_anggota = stripslashes(strip_tags(htmlspecialchars($_POST['jurusan_anggota'] ,ENT_QUOTES)));
$no_telp_anggota = stripslashes(strip_tags(htmlspecialchars($_POST['no_telp_anggota'] ,ENT_QUOTES)));
$alamat_anggota = stripslashes(strip_tags(htmlspecialchars($_POST['alamat_anggota'] ,ENT_QUOTES)));

if ($id_anggota == "") {
	$query = "INSERT into anggota (kode_anggota, nama_anggota, jk_anggota, jurusan_anggota, no_telp_anggota, alamat_anggota) VALUES (?, ?, ?, ?, ?, ?)";
	$anggota = $koneksi->prepare($query);
	$anggota->bind_param("ssssss", $kode_anggota, $nama_anggota, $jk_anggota, $jurusan_anggota, $no_telp_anggota, $alamat_anggota);
	$anggota->execute();
} else {
	$query = "UPDATE anggota SET kode_anggota=?, nama_anggota=?, jk_anggota=?, jurusan_anggota=?, no_telp_anggota=?, alamat_anggota=? WHERE id_anggota=?";
	$anggota = $koneksi->prepare($query);
	$anggota->bind_param("ssssssi", $kode_anggota, $nama_anggota, $jk_anggota, $jurusan_anggota, $no_telp_anggota, $alamat_anggota, $id_anggota);
	$anggota->execute();
}

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>