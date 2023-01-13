<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Jenis Kelamin</th>
            <th>Nomor Telepon</th>
            <th>Alamat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include '../config/koneksi.php';
            $no = 1;
            $query = "SELECT * FROM anggota ORDER BY nama_anggota ASC";
            $anggota = $koneksi->prepare($query);
            $anggota->execute();
            $result = $anggota->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id_anggota = $row['id_anggota'];
                    $kode_anggota = $row['kode_anggota'];
                    $nama_anggota = $row['nama_anggota'];
                    $jk_anggota = $row['jk_anggota'];
                    $jurusan_anggota = $row['jurusan_anggota'];
                    $no_telp_anggota = $row['no_telp_anggota'];
                    $alamat_anggota = $row['alamat_anggota'];
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $kode_anggota; ?></td>
                <td><?php echo $nama_anggota; ?></td>
                <td>
                    <?php 
                    switch ($jurusan_anggota) {
                        case 'IK':
                            echo 'Ilmu Komputer';
                            break;
                        case 'EK':
                            echo 'Ekonomi';
                            break;
                        case 'HU':
                            echo 'Hukum';
                            break;
                        case 'KD':
                            echo 'Kedokteran';
                            break;
                        case 'KP':
                            echo 'Keperawatan';
                            break;
                        case 'IS':
                            echo 'Ilmu Sejarah';
                            break;
                        case 'FM':
                            echo 'FMIPA';
                            break;
                        case 'FK':
                            echo 'FKIP';
                            break;
                        case 'KM':
                            echo 'Kesehatan Masyarakat';
                            break;
                        default:
                            echo '-';
                            break;
                    }
                    ?>
                </td>
                <td><?php echo ($jk_anggota=="L") ? 'Laki-Laki':'Perempuan'; ?></td>
                <td><?php echo $no_telp_anggota; ?></td>
                <td><?php echo $alamat_anggota; ?></td>
                <td>
                    <button id="<?php echo $id_anggota; ?>" class="btn btn-success btn-sm edit_data"> <i class="fa fa-edit"></i> Edit </button>
                    <button id="<?php echo $id_anggota; ?>" class="btn btn-danger btn-sm hapus_data"> <i class="fa fa-trash"></i> Hapus </button>
                </td>
            </tr>
        <?php } } else { ?> 
            <tr>
                <td colspan='8' class="text-center">Belum Ada Data</td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );

    $(document).on('click', '.edit_data', function(){
        var id_anggota = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "/anggota/edit.php",
            data: {id_anggota:id_anggota},
            dataType:'json',
            success: function(response) {
                document.getElementById("form-data").reset();
                document.getElementById("id_anggota").value = response.id_anggota;
                document.getElementById("kode_anggota").value = response.kode_anggota;
                document.getElementById("nama_anggota").value = response.nama_anggota;
                document.getElementById("jk_anggota").value = response.jk_anggota;
                document.getElementById("jurusan_anggota").value = response.jurusan_anggota;
                document.getElementById("no_telp_anggota").value = response.no_telp_anggota;
                document.getElementById("alamat_anggota").value = response.alamat_anggota;
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });

    $(document).on('click', '.hapus_data', function(){
        var id_anggota = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "/anggota/delete.php",
            data: {id_anggota:id_anggota},
            success: function() {
                $('.data').load("/anggota/read.php");
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });
</script>