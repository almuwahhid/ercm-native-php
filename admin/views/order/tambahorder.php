
<div class="dashboard-ecommerce">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Tambah Order</h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?page=daftarkirimbahan" class="breadcrumb-link">Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Order</li>
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
                  <label for="inputText3" class="col-form-label">Deskripsi</label>
                  <input required name="deskripsi" id="inputText3" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Tanggal</label>
                  <input required name="tanggal" type="date" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Total</label>
                  <input required name="total" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Customer ID</label>
                  <input required name="customers_id" type="text" class="form-control">
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

  if(isset($_POST['tanggal'])){
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];
    $total = $_POST['total'];
    $customers_id = $_POST['customers_id'];

    $hasil= mysqli_query($h, "INSERT INTO orderan(tanggal, deskripsi, total, customers_id)
                              values('$tanggal','$deskripsi', '$total', '$customers_id')");
    if($hasil){
        echo "
        <script>
          window.alert('Berhasil menambahkan data Order');
          window.location='index.php?page=daftarorder'
        </script>";
      }else{
        echo "
        <script>
          window.alert('Gagal menambah Order karena ".mysqli_error($h)."'');
        </script>";
        echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
}
?>
