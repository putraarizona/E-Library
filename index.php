<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Petugas | Perpustakaan</title>
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
						<a class="nav-link active" aria-current="page" href="index.php">Petugas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="anggota.php">Anggota</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="buku.php">Buku</a>
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
		<h2 class="text-center" style="margin: 30px;">Data Petugas</h2>
		<form method="post" class="form-data" id="form-data">
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						<label>Nama Petugas</label>
						<input type="hidden" name="id_petugas" id="id_petugas">
						<input type="text" name="nama_petugas" id="nama_petugas" class="form-control" required="true">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Jabatan Petugas</label>
						<input type="text" name="jabatan_petugas" id="jabatan_petugas" class="form-control" required="true">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>No. Handphone</label>
						<input type="text" name="no_telp_petugas" id="no_telp_petugas" class="form-control" required="true">
					</div>
				</div>
			</div>

			<div class="form-group mt-2">
				<label>Alamat</label>
				<textarea name="alamat_petugas" id="alamat_petugas" class="form-control" required="true"></textarea>
			</div>

			<div class="form-group mt-2">
				<button type="button" name="simpan" id="simpan" class="btn btn-primary">
					<i class="fa fa-save"></i> Simpan
				</button>
			</div>
		</form>
		<hr>

		<div class="data"></div>

	</div>

	<!-- Untuk Keperluan Demo Saya Menggunakan JQuery Online, Jika sobat menggunakan untuk keperluan developmen/production maka download JQuery pada situs resminya -->
	<!-- JQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- DataTable -->
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>

	<script src="assets/js/bootstrap.bundle.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.data').load("/petugas/read.php");
			$("#simpan").click(function() {
				var data = $('.form-data').serialize();
				var nama_petugas = document.getElementById("nama_petugas").value;
				var jabatan_petugas = document.getElementById("jabatan_petugas").value;
				var no_telp_petugas = document.getElementById("no_telp_petugas").value;
				var alamat_petugas = document.getElementById("alamat_petugas").value;

				if (nama_petugas != "" && jabatan_petugas != "" && no_telp_petugas != "" && alamat_petugas != "") {
					$.ajax({
						type: 'POST',
						url: "/petugas/create_update.php",
						data: data,
						success: function() {
							$('.data').load("/petugas/read.php");
							document.getElementById("id_petugas").value = "";
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