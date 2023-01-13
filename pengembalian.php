<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Pengembalian | Perpustakaan</title>
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
						<a class="nav-link" aria-current="page" href="buku.php">Buku</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="peminjaman.php">Peminjaman</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="pengembalian.php">Pengembalian</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<h2 class="text-center" style="margin: 30px;">Data Pengembalian</h2>

		<div class="data"></div>

	</div>

	<!-- JQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- DataTable -->
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>
	<!-- Moment JS -->
	<script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>

	<script src="assets/js/bootstrap.bundle.js"></script>
	<script type="text/javascript">
		moment.locale('id');
		$(document).ready(function() {
			$('.data').load("/pengembalian/read.php");
		});
	</script>
</body>

</html>