<?php
include '../config/koneksi.php';

$id_anggota = $_POST['id_anggota'];
$query = "SELECT * FROM anggota WHERE id_anggota=?";
$anggota = $koneksi->prepare($query);
$anggota->bind_param('i', $id_anggota);
$anggota->execute();
$result = $anggota->get_result();
while ($row = $result->fetch_assoc()) {
    $data['id_anggota'] = $row["id_anggota"];
    $data['kode_anggota'] = $row["kode_anggota"];
    $data['nama_anggota'] = $row["nama_anggota"];
    $data['jk_anggota'] = $row["jk_anggota"];
    $data['jurusan_anggota'] = $row["jurusan_anggota"];
    $data['no_telp_anggota'] = $row["no_telp_anggota"];
    $data['alamat_anggota'] = $row["alamat_anggota"];
}
echo json_encode($data);

$koneksi->close();
?>