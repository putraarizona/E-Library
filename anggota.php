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
						<a class="nav-link active" aria-current="page" href="anggota.php">Anggota</a>
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
		<h2 class="text-center" style="margin: 30px;">Data Anggota</h2>
		<form method="post" class="form-data" id="form-data">
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						<label>Kode</label>
						<input type="hidden" name="id_anggota" id="id_anggota">
						<input type="text" name="kode_anggota" id="kode_anggota" class="form-control" required="true">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama_anggota" id="nama_anggota" class="form-control" required="true">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Jurusan</label>
						<select name="jurusan_anggota" id="jurusan_anggota" class="form-select">
							<option value="IK">Ilmu Komputer</option>
							<option value="EK">Ekonomi</option>
							<option value="HU">Hukum</option>
							<option value="KD">Kedokteran</option>
							<option value="KP">Keperawatan</option>
							<option value="IS">Ilmu Sejarah</option>
							<option value="FM">FMIPA</option>
							<option value="FK">FKIP</option>
							<option value="KM">Kesehatan Masyarakat</option>
						</select>
					</div>
				</div>
			</div>

			<div class="row mt-4">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="jk_anggota">Jenis Kelamin</label>
						<select name="jk_anggota" id="jk_anggota" class="form-select">
							<option value="L">Laki-Laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="no_telp_anggota">Nomor Telepon</label>
						<input type="text" name="no_telp_anggota" id="no_telp_anggota" class="form-control" required="true">
					</div>
				</div>
			</div>

			<div class="form-group mt-4">
				<label>Alamat</label>
				<textarea name="alamat_anggota" id="alamat_anggota" class="form-control" required="true"></textarea>
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
			$('.data').load("/anggota/read.php");
			$("#simpan").click(function() {
				var data = $('.form-data').serialize();
				var kode_anggota = document.getElementById("kode_anggota").value;
				var nama_anggota = document.getElementById("nama_anggota").value;
				var jk_anggota = document.getElementById("jk_anggota").value;
				var jurusan_anggota = document.getElementById("jurusan_anggota").value;
				var no_telp_anggota = document.getElementById("no_telp_anggota").value;
				var alamat_anggota = document.getElementById("alamat_anggota").value;

				if (kode_anggota != "" && nama_anggota != "" && jk_anggota != "" && jurusan_anggota != "" && no_telp_anggota != "" && alamat_anggota != "") {
					$.ajax({
						type: 'POST',
						url: "/anggota/create_update.php",
						data: data,
						success: function() {
							$('.data').load("/anggota/read.php");
							document.getElementById("id_anggota").value = "";
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