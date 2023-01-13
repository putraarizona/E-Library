<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Stok</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include '../config/koneksi.php';
            $no = 1;
            $query = "SELECT * FROM buku ORDER BY judul_buku ASC";
            $buku = $koneksi->prepare($query);
            $buku->execute();
            $result = $buku->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id_buku = $row['id_buku'];
                    $kode_buku = $row['kode_buku'];
                    $judul_buku = $row['judul_buku'];
                    $penulis_buku = $row['penulis_buku'];
                    $penerbit_buku = $row['penerbit_buku'];
                    $tahun_terbit = $row['tahun_terbit'];
                    $stok = $row['stok'];
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $kode_buku; ?></td>
                <td><?php echo $judul_buku; ?></td>
                <td><?php echo $penulis_buku; ?></td>
                <td><?php echo $penerbit_buku; ?></td>
                <td><?php echo $tahun_terbit; ?></td>
                <td><?php echo $stok; ?></td>
                <td>
                    <button id="<?php echo $id_buku; ?>" class="btn btn-success btn-sm edit_data"> <i class="fa fa-edit"></i> Edit </button>
                    <button id="<?php echo $id_buku; ?>" class="btn btn-danger btn-sm hapus_data"> <i class="fa fa-trash"></i> Hapus </button>
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
        var id_buku = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "/buku/edit.php",
            data: {id_buku:id_buku},
            dataType:'json',
            success: function(response) {
                document.getElementById("form-data").reset();
                document.getElementById("id_buku").value = response.id_buku;
                document.getElementById("kode_buku").value = response.kode_buku;
                document.getElementById("judul_buku").value = response.judul_buku;
                document.getElementById("penulis_buku").value = response.penulis_buku;
                document.getElementById("penerbit_buku").value = response.penerbit_buku;
                document.getElementById("tahun_terbit").value = response.tahun_terbit;
                document.getElementById("stok").value = response.stok;
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });

    $(document).on('click', '.hapus_data', function(){
        var id_buku = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "/buku/delete.php",
            data: {id_buku:id_buku},
            success: function() {
                $('.data').load("/buku/read.php");
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });
</script>