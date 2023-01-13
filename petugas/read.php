<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include '../config/koneksi.php';
            $no = 1;
            $query = "SELECT * FROM petugas ORDER BY nama_petugas ASC";
            $petugas = $koneksi->prepare($query);
            $petugas->execute();
            $result = $petugas->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id_petugas = $row['id_petugas'];
                    $nama_petugas = $row['nama_petugas'];
                    $jabatan_petugas = $row['jabatan_petugas'];
                    $no_telp_petugas = $row['no_telp_petugas'];
                    $alamat_petugas = $row['alamat_petugas'];
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $nama_petugas; ?></td>
                <td><?php echo $jabatan_petugas; ?></td>
                <td><?php echo $no_telp_petugas; ?></td>
                <td><?php echo $alamat_petugas; ?></td>
                <td>
                    <button id="<?php echo $id_petugas; ?>" class="btn btn-success btn-sm edit_data"> <i class="fa fa-edit"></i> Edit </button>
                    <button id="<?php echo $id_petugas; ?>" class="btn btn-danger btn-sm hapus_data"> <i class="fa fa-trash"></i> Hapus </button>
                </td>
            </tr>
        <?php } } else { ?> 
            <tr>
                <td colspan='6' class="text-center">Belum Ada Data</td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );

    $(document).on('click', '.edit_data', function(){
        var id_petugas = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "/petugas/edit.php",
            data: {id_petugas:id_petugas},
            dataType:'json',
            success: function(response) {
                document.getElementById("form-data").reset();
                document.getElementById("id_petugas").value = response.id_petugas;
                document.getElementById("nama_petugas").value = response.nama_petugas;
                document.getElementById("jabatan_petugas").value = response.jabatan_petugas;
                document.getElementById("no_telp_petugas").value = response.no_telp_petugas;
                document.getElementById("alamat_petugas").value = response.alamat_petugas;
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });

    $(document).on('click', '.hapus_data', function(){
        var id_petugas = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "/petugas/delete.php",
            data: {id_petugas:id_petugas},
            success: function() {
                $('.data').load("/petugas/read.php");
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });
</script>