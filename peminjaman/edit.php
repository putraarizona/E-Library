<?php
include '../config/koneksi.php';

$id_peminjaman = $_POST['id_peminjaman'];
$query = "SELECT * FROM peminjaman WHERE id_peminjaman=?";
$peminjaman = $koneksi->prepare($query);
$peminjaman->bind_param('i', $id_peminjaman);
$peminjaman->execute();
$result = $peminjaman->get_result();
while ($row = $result->fetch_assoc()) {
    $data['id_peminjaman'] = $row["id_peminjaman"];
    $data['id_anggota'] = $row["id_anggota"];
    $data['id_petugas'] = $row["id_petugas"];
    $data['id_buku'] = $row["id_buku"];
    $data['tanggal_pinjam'] = $row["tanggal_pinjam"];
    $data['tanggal_kembali'] = $row["tanggal_kembali"];
}
echo json_encode($data);

$koneksi->close();
?>