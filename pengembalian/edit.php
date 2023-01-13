<?php
include '../config/koneksi.php';

$id_pengembalian = $_POST['id_pengembalian'];
$query = "SELECT * FROM pengembalian WHERE id_pengembalian=?";
$pengembalian = $koneksi->prepare($query);
$pengembalian->bind_param('i', $id_pengembalian);
$pengembalian->execute();
$result = $pengembalian->get_result();
while ($row = $result->fetch_assoc()) {
    $data['id_pengembalian'] = $row["id_pengembalian"];
    $data['id_anggota'] = $row["id_anggota"];
    $data['id_petugas'] = $row["id_petugas"];
    $data['id_buku'] = $row["id_buku"];
    $data['denda'] = $row["denda"];
    $data['tanggal_pengembalian'] = $row["tanggal_pengembalian"];
}
echo json_encode($data);

$koneksi->close();
?>