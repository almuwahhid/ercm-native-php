
<?php
  $iddata=$_GET['id'];
  $hasil=mysqli_query($h, "SELECT * from orderan where no_order = '$iddata'");
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
          <h2 class="pageheader-title">Edit Order</h2>
          <p class="pageheader-text"></p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Order</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $row["tanggal"];  ?></li>
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
                <input name="id" type="hidden" class="form-control" value="<?php echo $row['no_order'];  ?>">
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Deskripsi</label>
                  <input required name="deskripsi" type="text" class="form-control" value="<?php echo $row['deskripsi'];  ?>">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Tanggal</label>
                  <input required name="tanggal" id="inputText3" type="date" class="form-control" value="<?php echo $row['tanggal'];  ?>">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Total</label>
                  <input required name="total" typeal="number" step="any" class="form-control" value="<?php echo $row['total'];  ?>" />
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Customer</label>
                  <input required name="customers_id" type="number" step="any" class="form-control" value="<?php echo $row['customers_id'];  ?>" />
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
  if(isset($_POST['tanggal'])){
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];
    $total = $_POST['total'];
    $customers_id = $_POST['customers_id'];


      $hasil = mysqli_query($h, "UPDATE orderan SET tanggal = '".$tanggal."', deskripsi = '".$deskripsi."', total = '".$total."', customers_id = '".$customers_id."' WHERE no_order= ".$id);

    if($hasil){
        echo "
        <script>
          window.alert('Berhasil mengupdate data Order');
          window.location='index.php?page=daftarorder';
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }else{
        echo "
        <script>
          window.alert('Gagal menambah Order karena ".mysqli_error($h)."'');
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
  }

?>
