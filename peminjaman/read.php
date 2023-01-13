<form method="post" class="form-data" id="form-data">
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Petugas</label>
                <input type="hidden" name="id_peminjaman" id="id_peminjaman">
                <select name="id_petugas" id="id_petugas" class="form-select" required>
                    <?php
                    include '../config/koneksi.php';
                    $query = "SELECT * FROM petugas ORDER BY nama_petugas ASC";
                    $petugas = $koneksi->prepare($query);
                    $petugas->execute();
                    $result = $petugas->get_result();

                    if ($result->num_rows > 0) {
                        ?>
                        <option value="">Pilih Petugas</option>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $id_petugas = $row['id_petugas'];
                            $nama_petugas = $row['nama_petugas'];
                            ?>
                            <option value="<?=$id_petugas?>"><?=$nama_petugas?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="">Tidak Ada Petugas</option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Anggota</label>
                <select name="id_anggota" id="id_anggota" class="form-select" required>
                    <?php
                    include '../config/koneksi.php';
                    $query = "SELECT * FROM anggota ORDER BY nama_anggota ASC";
                    $anggota = $koneksi->prepare($query);
                    $anggota->execute();
                    $result = $anggota->get_result();

                    if ($result->num_rows > 0) {
                        ?>
                        <option value="">Pilih Anggota</option>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $id_anggota = $row['id_anggota'];
                            $nama_anggota = $row['nama_anggota'];
                            ?>
                            <option value="<?=$id_anggota?>"><?=$nama_anggota?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="">Tidak Ada Anggota</option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Buku</label>
                <select name="id_buku" id="id_buku" class="form-select" required>
                    <?php
                    include '../config/koneksi.php';
                    $query = "SELECT * FROM buku WHERE stok > 0 ORDER BY judul_buku ASC";
                    $buku = $koneksi->prepare($query);
                    $buku->execute();
                    $result = $buku->get_result();

                    if ($result->num_rows > 0) {
                        ?>
                        <option value="">Pilih Buku</option>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $id_buku = $row['id_buku'];
                            $judul_buku = $row['judul_buku'];
                            ?>
                            <option value="<?=$id_buku?>"><?=$judul_buku?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="">Tidak Ada Buku</option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="tanggal_pinjam">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required="true">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required="true">
            </div>
        </div>
    </div>

    <div class="form-group mt-4">
        <button type="button" name="simpan" id="simpan" class="btn btn-primary">
            <span class="fa fa-save"></span> Simpan
        </button>
    </div>
</form>
<hr>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Anggota</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Petugas</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $no = 1;
            $query = "SELECT peminjaman.id_peminjaman, anggota.nama_anggota, petugas.nama_petugas, buku.judul_buku, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali FROM peminjaman INNER JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota INNER JOIN petugas ON peminjaman.id_petugas = petugas.id_petugas INNER JOIN buku ON peminjaman.id_buku = buku.id_buku ORDER BY tanggal_pinjam DESC";
            $peminjaman = $koneksi->prepare($query);
            $peminjaman->execute();
            $result = $peminjaman->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id_peminjaman = $row['id_peminjaman'];
                    $nama_anggota = $row['nama_anggota'];
                    $nama_petugas = $row['nama_petugas'];
                    $judul_buku = $row['judul_buku'];
                    $tanggal_pinjam = $row['tanggal_pinjam'];
                    $tanggal_kembali = $row['tanggal_kembali'];
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $nama_anggota; ?></td>
                <td><?php echo $judul_buku; ?></td>
                <td><?php echo $tanggal_pinjam; ?></td>
                <td><?php echo $tanggal_kembali; ?></td>
                <td><?php echo $nama_petugas; ?></td>
                <td>
                    <button id="<?php echo $id_peminjaman; ?>" class="btn btn-success btn-sm edit_data"> <i class="fa fa-edit"></i> Edit </button>
                    <button id="<?php echo $id_peminjaman; ?>" class="btn btn-danger btn-sm hapus_data"> <i class="fa fa-trash"></i> Hapus </button>
                </td>
            </tr>
        <?php } } else { ?> 
            <tr>
                <td colspan='7' class="text-center">Belum Ada Data</td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );

    $(document).on('click', '.edit_data', function(){
        var id_peminjaman = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "/peminjaman/edit.php",
            data: {id_peminjaman:id_peminjaman},
            dataType:'json',
            success: function(response) {
                document.getElementById("form-data").reset();
                document.getElementById("id_peminjaman").value = response.id_peminjaman;
                document.getElementById("id_anggota").value = response.id_anggota;
                document.getElementById("id_buku").value = response.id_buku;
                document.getElementById("id_petugas").value = response.id_petugas;
                document.getElementById("tanggal_pinjam").value = response.tanggal_pinjam;
                document.getElementById("tanggal_kembali").value = response.tanggal_kembali;
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });

    $(document).on('click', '.hapus_data', function(){
        var id_peminjaman = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "/peminjaman/delete.php",
            data: {id_peminjaman:id_peminjaman},
            success: function() {
                $('.data').load("/peminjaman/read.php");
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });


    $("#simpan").click(function() {
        var data = $('.form-data').serialize();
        var id_petugas = document.getElementById("id_petugas").value;
        var id_anggota = document.getElementById("id_anggota").value;
        var id_buku = document.getElementById("id_buku").value;
        var tanggal_pinjam = moment(document.getElementById("tanggal_pinjam").value).format("YYYY-MM-DD");
        var tanggal_kembali = moment(document.getElementById("tanggal_kembali").value).format("YYYY-MM-DD");

        if (id_petugas != "" && id_anggota != "" && id_buku != "" && tanggal_pinjam != "" && tanggal_kembali != "") {
            $.ajax({
                type: 'POST',
                url: "/peminjaman/create_update.php",
                data: data,
                success: function() {
                    $('.data').load("/peminjaman/read.php");
                    document.getElementById("id_peminjaman").value = "";
                    document.getElementById("form-data").reset();
                },
                error: function(response) {
                    console.log(response.responseText);
                }
            });
        }

    });
</script>