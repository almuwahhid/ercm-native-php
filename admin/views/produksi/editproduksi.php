<?php
  $iddata=$_GET['id'];
  $hasil=mysqli_query($h, "SELECT * from produksi where no_produksi = '$iddata'");
  $row = mysqli_fetch_assoc($hasil);

  $id_produk = $row['produk_id'];
  $produk = mysqli_query($h, "SELECT * from produk");
?>

<div class="dashboard-ecommerce">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Edit Produksi</h2>
          <p class="pageheader-text"></p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Produksi</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $row["tanggal_selesai"];  ?></li>
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
                <input name="id" type="hidden" class="form-control" value="<?php echo $row['no_produksi'];  ?>">
                
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Tanggal Selesai</label>
                  <input required name="tanggal_selesai" id="inputText3" type="date" class="form-control" value="<?php echo $row['tanggal_selesai'];  ?>">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Jumlah Produksi</label>
                  <input required name="jml_produksi" type="text" class="form-control" value="<?php echo $row['jml_produksi'];  ?>">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Biaya Bahan</label>
                  <input required name="biaya_bahan" type="text" step="any" class="form-control" value="<?php echo $row['biaya_bahan'];  ?>" />
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Biaya Tkl</label>
                  <input required name="biaya_tkl" type="text" step="any" class="form-control" value="<?php echo $row['biaya_tkl'];  ?>" />
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Biaya Produksi</label>
                  <input required name="biaya_produksi" type="text" step="any" class="form-control" value="<?php echo $row['biaya_produksi'];  ?>" />
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Produk</label>
                  <select name="produk_id" class="form-control">
                                      <?php
                                      while($prod = $produk->fetch_array()){
                                        ?>
                                            <option value="<?= $prod['produk_id'] ?>"
                                              <?php if($prod['produk_id'] == $row['produk_id']) echo "selected"; ?> >
                                              <?= $prod['nama_produk'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>

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
  if(isset($_POST['tanggal_selesai'])){
    $id = $_POST['id'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $jml_produksi = $_POST['jml_produksi'];
    $biaya_bahan = $_POST['biaya_bahan'];
    $biaya_tkl = $_POST['biaya_tkl'];
    $biaya_produksi = $_POST['biaya_produksi'];
    $produk_id = $_POST['produk_id'];


      $hasil = mysqli_query($h, "UPDATE produksi SET tanggal_selesai = '".$tanggal_selesai."', jml_produksi = '".$jml_produksi."', biaya_bahan = '".$biaya_bahan."', biaya_tkl = '".$biaya_tkl."', biaya_produksi = '".$biaya_produksi."', produk_id = '".$produk_id."' WHERE no_produksi= ".$id);

    if($hasil){
        echo "
        <script>
          window.alert('Berhasil mengupdate data produksi');
          window.location='index.php?page=daftarproduksi';
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }else{
        echo "
        <script>
          window.alert('Gagal menambah produksi karena ".mysqli_error($h)."'');
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
  }

?>
