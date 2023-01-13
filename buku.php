<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Anggota | Perpustakaan</title>
	<link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
	<!-- Bootstrap -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- Datatable -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.css" />
</head>

<body class="min-vh-100">
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="container-fluid">
			<a class="navbar-brand" href="/">Perpustakaan</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="index.php">Petugas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="anggota.php">Anggota</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="buku.php">Buku</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="peminjaman.php">Peminjaman</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="pengembalian.php">Pengembalian</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<h2 class="text-center" style="margin: 30px;">Data Buku</h2>
		<form method="post" class="form-data" id="form-data">
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						<label>Kode</label>
						<input type="hidden" name="id_buku" id="id_buku">
						<input type="text" name="kode_buku" id="kode_buku" class="form-control" required="true">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Judul</label>
						<input type="text" name="judul_buku" id="judul_buku" class="form-control" required="true">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Penulis</label>
						<input type="text" name="penulis_buku" id="penulis_buku" class="form-control" required="true">
					</div>
				</div>
			</div>

            <div class="row mt-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="penerbit_buku">Penerbit</label>
						<input type="text" name="penerbit_buku" id="penerbit_buku" class="form-control" required="true">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
						<input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control" required="true">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="stok">Stok</label>
						<input type="number" name="stok" id="stok" class="form-control" required="true">
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

		<div class="data"></div>

	</div>

	<!-- JQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- DataTable -->
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>

	<script src="assets/js/bootstrap.bundle.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.data').load("/buku/read.php");
			$("#simpan").click(function() {
				var data = $('.form-data').serialize();
				var kode_buku = document.getElementById("kode_buku").value;
				var judul_buku = document.getElementById("judul_buku").value;
				var penulis_buku = document.getElementById("penulis_buku").value;
				var penerbit_buku = document.getElementById("penerbit_buku").value;
				var tahun_terbit = document.getElementById("tahun_terbit").value;
				var stok = document.getElementById("stok").value;

				if (kode_buku != "" && judul_buku != "" && penulis_buku != "" && penerbit_buku != "" && tahun_terbit != "" && stok != "") {
					$.ajax({
						type: 'POST',
						url: "/buku/create_update.php",
						data: data,
						success: function() {
							$('.data').load("/buku/read.php");
							document.getElementById("id_buku").value = "";
							document.getElementById("form-data").reset();
						},
						error: function(response) {
							console.log(response.responseText);
						}
					});
				}

			});
		});
	</script>
</body>

</html>