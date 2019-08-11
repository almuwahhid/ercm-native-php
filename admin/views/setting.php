<?php
$id = $_SESSION['admin'];
$hasil = mysqli_query($h, "SELECT * from admin where id_admin = '$id'");
$data = mysqli_fetch_assoc($hasil);
?>
<div class="dashboard-ecommerce" style="
    min-height: 565px;">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Setting </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Setting</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader  -->
    <!-- ============================================================== -->
    <div class="ecommerce-widget">
      <div class="row">
        <!-- ============================================================== -->

        <!-- ============================================================== -->

        <!-- recent orders  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <h5 class="card-header">Masukkan seluruh data dengan benar!</h5>
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $data["id_admin"]; ?>" name="id">
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Username</label>
                  <input required name="username" id="inputText3" type="text" class="form-control" value="<?php echo $data["username"]; ?>">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Nama</label>
                  <input required name="nama" type="text" class="form-control" value="<?php echo $data["nama"]; ?>">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Password Lama</label>
                  <input required name="passwordlama" type="password" step="any" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Password Baru</label>
                  <input required name="passwordbaru" type="password" step="any" class="form-control">
                </div>
                <div class="custom-file mb-3">
                  <input type="submit" href="#" class="centerHorizontal btn btn-primary" value="Ubah"></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
if(isset($_POST['nama'])){
  $id_admin = $_SESSION['admin'];
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $p_lama = md5($_POST['passwordlama']);
  $p_baru = md5($_POST['passwordbaru']);

  $hasil=mysqli_query($h, "SELECT * from admin WHERE id_admin = '$id_admin'");
  $data = mysqli_fetch_assoc($hasil);
  if($data["password"] == $p_lama){
    $q = mysqli_query($h, "UPDATE admin SET nama = '".$nama."', password = '".$p_baru."', username = '".$username."' WHERE id_admin = ".$id_admin);
    if($q){
      echo "
          <script>
          window.alert('Berhasil mengubah setting admin');
          </script>";
      echo "<meta http-equiv='refresh' content='0; url=index.php?page=logout'>";
    }
  }else{
    echo "
        <script>
        window.alert('Password Anda Salah');
        </script>";
  }
}
?>
