<?php
session_start();
require_once '../koneksi.php';
$koneksi = new Koneksi();
$h = $koneksi->connect();
if (isset($_SESSION['super_user'])){
	header("Location: index.php");
	// coba
}

// $hasil=mysqli_query($h, "SELECT * from super_user where no_id = 'id'");
// $row = mysqli_fetch_assoc($hasil);
// $id_produksi = $row['no_id'];
$produksy = mysqli_query($h, "SELECT * from super_user");
?>


<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/concept/style.css">
	<link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
	<style>
	html,
	body {
		height: 100%;
	}

	body {
		display: -ms-flexbox;
		display: flex;
		-ms-flex-align: center;
		align-items: center;
		padding-top: 40px;
		padding-bottom: 40px;
	}
	</style>
</head>

<body>
	<!-- ============================================================== -->
	<!-- login page  -->
	<!-- ============================================================== -->
	<div class="splash-container">
		<div class="card ">
			<div class="card-header text-center"><span class="splash-description">LOGIN ADMIN</span></div>
			<div class="card-body">
				<form role="form" action="" method="post">
					<div class="form-group">
						<input name="username" required class="form-control form-control-lg" id="username" type="text" placeholder="Username" autocomplete="off">
					</div>
					<div class="form-group">
						<input name="password" required class="form-control form-control-lg" id="password" type="password" placeholder="Password">
					</div>
					<div class="form-group">
						<select name="level" class="form-control">
							<option value="1">Manager</option>
							<option value="2">Marketting</option>
							<option value="3">Bagian Produksi</option>
							<option value="4">Supplier</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
				</form>
			</div>
		</div>
	</div>

	<!-- ============================================================== -->
	<!-- end login page  -->
	<!-- ============================================================== -->
	<!-- Optional JavaScript -->
	<script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>

<?php
if(isset($_POST['username'])){
	$uname = $_POST['username'];
	$mypassword = md5(($_POST['password']));

	$mylevel = ($_POST['level']);
	if($mylevel == 4){
		$hasil  =  mysqli_query($h, "SELECT * FROM supplier JOIN level ON supplier.id_level = level.id_level WHERE username = '$uname' AND level.id_level = '$mylevel' ") or die('Could not look up user information; ' . mysqli_error($h));
	} else {
		$hasil  =  mysqli_query($h, "SELECT * FROM super_user JOIN level ON super_user.id_level = level.id_level WHERE username = '$uname' AND level.id_level = '$mylevel' ") or die('Could not look up user information; ' . mysqli_error($h));
	}
	$data = mysqli_fetch_assoc($hasil);
	if ($uname=="" && $mypassword=="" && $mylevel==""){
		echo "
		<script>
			window.alert('Username atau Password tidak boleh kosong');
			window.location='login.php'
		</script>
		";
	}else if ($data['username'] == $uname){
		if ($data['password'] == $mypassword){
			if ($data['id_level'] == $mylevel){
				$_SESSION['super_user'] = json_encode($data);
				// $_SESSION['nama'] = $data['nama'];
				echo "<meta http-equiv='refresh' content='0; url=index.php'>";
			}
		}
		else{
			echo "
			<script>
				window.alert('Password salah');
				window.location='login.php'
			</script>
			";
		}
	}else{
		echo "
		<script>
			window.alert('Anda tidak memiliki akses');
			window.location='login.php'
		</script>
		";
	}
}
?>
