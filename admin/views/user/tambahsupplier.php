
<div class="dashboard-ecommerce">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Tambah Supplier</h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Supplier</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Supplier</li>
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
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Nama Supplier</label>
                  <input required name="nama" id="inputText3" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Email</label>
                  <input required name="email" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Username</label>
                  <input required name="username" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Password</label>
                  <input required name="password" type="text" step="any" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Alamat</label>
                  <input required name="alamat" type="text" step="any" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Telp</label>
                  <input required name="telp" type="number" step="any" class="form-control">
                </div>
                <div class="custom-file mb-3">
                  <input type="submit" href="#" class="centerHorizontal btn btn-primary" value="Tambahkan"></a>
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
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    $hasil= mysqli_query($h, "INSERT INTO supplier(nama, email, username, password, alamat, telp , id_level)
                              values('$nama', '$email', '$username', '$password', '$alamat', '$telp' , '4')");
    if($hasil){
        echo "
        <script>
          window.alert('Berhasil menambahkan data supplier');
          window.location='index.php?page=daftarsupplier'
        </script>";
      }else{
        echo "
        <script>
          window.alert('Gagal menambah supplier karena ".mysqli_error($h)."'');
        </script>";
        echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
}
?>
