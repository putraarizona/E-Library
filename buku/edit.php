<?php
include '../config/koneksi.php';

$id_buku = $_POST['id_buku'];
$query = "SELECT * FROM buku WHERE id_buku=?";
$buku = $koneksi->prepare($query);
$buku->bind_param('i', $id_buku);
$buku->execute();
$result = $buku->get_result();
while ($row = $result->fetch_assoc()) {
    $data['id_buku'] = $row["id_buku"];
    $data['kode_buku'] = $row["kode_buku"];
    $data['judul_buku'] = $row["judul_buku"];
    $data['penulis_buku'] = $row["penulis_buku"];
    $data['penerbit_buku'] = $row["penerbit_buku"];
    $data['tahun_terbit'] = $row["tahun_terbit"];
    $data['stok'] = $row["stok"];
}
echo json_encode($data);

$koneksi->close();
?>