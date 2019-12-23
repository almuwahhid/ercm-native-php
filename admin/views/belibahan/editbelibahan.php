<?php
  $iddata=$_GET['id'];
  $hasil = mysqli_query($h, "SELECT * from purchase_bahan
                            JOIN bahan ON purchase_bahan.bahan_id = bahan.bahan_id
                            JOIN supplier ON bahan.supplier_id = supplier.supplier_id
                            where id = '$iddata'");
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
          <h2 class="pageheader-title">Edit Pembelian Bahan</h2>
          <p class="pageheader-text"></p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Pembelian Bahan</a></li>
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
                <input name="id" type="hidden" class="form-control" value="<?php echo $iddata;  ?>">
                <input name="harga" type="hidden" class="form-control" value="<?php echo $row['harga'];  ?>">
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Nama Bahan</label>
                  <input disabled name="bahan" class="form-control" value="<?php echo $row['nama_bahan'];  ?>">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Jumlah Pembelian</label>
                  <input required name="jml_kbp" type="number" class="form-control" value="<?php echo $row['jml_kbp'];  ?>">
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
  if(isset($_POST['jml_kbp'])){
    $id = $_POST['id'];
    $harga = $_POST['harga'];
    $jml_kbp = $_POST['jml_kbp'];
    $biaya_bahan = $harga*$jml_kbp;
    $hasil = mysqli_query($h, "UPDATE purchase_bahan SET jml_kbp = '".$jml_kbp."', biaya_bahan = '".$biaya_bahan."' WHERE id= ".$id);
    if($hasil){
        echo "
        <script>
          window.alert('Berhasil mengupdate data Pembelian Bahan');
          window.location='index.php?page=daftarbelibahan';
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }else{
        echo "
        <script>
          window.alert('Gagal menambah Pembelian Bahan karena ".mysqli_error($h)."'');
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
  }

?>
