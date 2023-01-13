<?php
include '../config/koneksi.php';

$id_petugas = stripslashes(strip_tags(htmlspecialchars($_POST['id_petugas'] ,ENT_QUOTES)));
$nama_petugas = stripslashes(strip_tags(htmlspecialchars($_POST['nama_petugas'] ,ENT_QUOTES)));
$jabatan_petugas = stripslashes(strip_tags(htmlspecialchars($_POST['jabatan_petugas'] ,ENT_QUOTES)));
$no_telp_petugas = stripslashes(strip_tags(htmlspecialchars($_POST['no_telp_petugas'] ,ENT_QUOTES)));
$alamat_petugas = stripslashes(strip_tags(htmlspecialchars($_POST['alamat_petugas'] ,ENT_QUOTES)));

if ($id_petugas == "") {
	$query = "INSERT into petugas (nama_petugas, jabatan_petugas, no_telp_petugas, alamat_petugas) VALUES (?, ?, ?, ?)";
	$petugas = $koneksi->prepare($query);
	$petugas->bind_param("ssss", $nama_petugas, $jabatan_petugas, $no_telp_petugas, $alamat_petugas);
	$petugas->execute();
} else {
	$query = "UPDATE petugas SET nama_petugas=?, jabatan_petugas=?, no_telp_petugas=?, alamat_petugas=? WHERE id_petugas=?";
	$petugas = $koneksi->prepare($query);
	$petugas->bind_param("ssssi", $nama_petugas, $jabatan_petugas, $no_telp_petugas, $alamat_petugas, $id_petugas);
	$petugas->execute();
}

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>