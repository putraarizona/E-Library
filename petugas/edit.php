<?php
include '../config/koneksi.php';

$id_petugas = $_POST['id_petugas'];
$query = "SELECT * FROM petugas WHERE id_petugas=?";
$petugas = $koneksi->prepare($query);
$petugas->bind_param('i', $id_petugas);
$petugas->execute();
$result = $petugas->get_result();
while ($row = $result->fetch_assoc()) {
    $data['id_petugas'] = $row["id_petugas"];
    $data['nama_petugas'] = $row["nama_petugas"];
    $data['jabatan_petugas'] = $row["jabatan_petugas"];
    $data['no_telp_petugas'] = $row["no_telp_petugas"];
    $data['alamat_petugas'] = $row["alamat_petugas"];
}
echo json_encode($data);

$koneksi->close();
?>