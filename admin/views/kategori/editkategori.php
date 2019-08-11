
<?php
  $iddata=$_GET['id'];
  $hasil=mysqli_query($h, "SELECT * from kategori where kategori_id = '$iddata'");
  $row = mysqli_fetch_assoc($hasil);

?>


<div class="dashboard-ecommerce">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Edit Kategori</h2>
          <p class="pageheader-text"></p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Kategori</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $row["nama_kategori"];  ?></li>
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
                <input name="id" type="hidden" class="form-control" value="<?php echo $row['kategori_id'];  ?>">
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Nama kategori</label>
                  <input required name="nama_kategori" id="inputText3" type="text" class="form-control" value="<?php echo $row['nama_kategori'];  ?>">
                </div>
                <div class="custom-file mb-3">
                  <input type="submit" href="#" class="col-xl-4 centerHorizontal btn btn-primary" value="Ubah"></a>
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
  if(isset($_POST['nama_kategori'])){
    $id = $_POST['id'];
    $nama = $_POST['nama_kategori'];


      $hasil = mysqli_query($h, "UPDATE kategori SET nama_kategori = '".$nama."' WHERE kategori_id= ".$id);

    if($hasil){
        echo "
        <script>
          window.alert('Berhasil mengupdate data kategori');
          window.location='index.php?page=daftarkategori';
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }else{
        echo "
        <script>
          window.alert('Gagal menambah kategori karena ".mysqli_error($h)."'');
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
  }

?>
