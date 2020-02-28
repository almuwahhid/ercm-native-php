<?php
  $bahan = mysqli_query($h, "SELECT * from bahan");
?>

<div class="dashboard-ecommerce">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Tambah Pembelian Bahan</h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?page=daftarbelibahan" class="breadcrumb-link">Pembelian Bahan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Pembelian Bahan</li>
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
                <input name="id" type="hidden" class="form-control" value="<?php echo $row['id'];  ?>">
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Bahan</label>
                  <select name="bahan" class="form-control">
                                      <?php
                                      while($sup = $bahan->fetch_array()){
                                        ?>
                                            <option value='<?= json_encode($sup) ?>'>
                                              <?= $sup['nama_bahan']." - Rp.".number_format($sup['harga'],2,',','.')." / ".$sup['satuan'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                  </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Jumlah Pembelian</label>
                  <input required name="jml_kbp" type="text" class="form-control">
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

  if(isset($_POST['bahan'])){
    $tanggal = date('Y-m-d');
    $jml_kbp = $_POST['jml_kbp'];
    $bahan = json_decode($_POST['bahan']);

    $hasil= mysqli_query($h, "INSERT INTO purchase_bahan(tanggal, bahan_id, jml_kbp)
                              values('$tanggal', '$bahan->bahan_id', '$jml_kbp')");
    if($hasil){
        echo "
        <script>
          window.alert('Berhasil menambahkan data Pembelian Bahan');
          window.location='index.php?page=daftarbelibahan'
        </script>";
      }else{
        echo "
        <script>
          window.alert('Gagal menambah Pembelian Bahan karena ".mysqli_error($h)."'');
        </script>";
        echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
}
?>
