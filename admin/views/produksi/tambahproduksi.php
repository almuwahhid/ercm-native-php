<?php

  $hasil=mysqli_query($h, "SELECT * from produksi where no_produksi = 'id'");
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
          <h2 class="pageheader-title">Tambah Produksi</h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Produksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Produksi</li>
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
              <form action="" method="post">
                <!-- <input name="id" type="hidden" class="form-control" value="<?php echo $row['no_produksi'];  ?>"> -->
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
                  <div class="form-group">
                  <label for="inputText3" class="col-form-label">Tanggal Selesai</label>
                  <input required name="tanggal_selesai" id="inputText3" type="date" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Jumlah Produksi</label>
                  <input required name="jml_produksi" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Biaya Tenaga Kerja Lepas</label>
                  <input required name="biaya_tkl" type="text" step="any" class="form-control">
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

if(isset($_POST['tanggal_selesai'])){
  // $id = $_POST['id'];
  $tanggal_selesai = $_POST['tanggal_selesai'];
  $produk_id = $_POST['produk_id'];
  $jml_produksi = $_POST['jml_produksi'];
  $biaya_tkl = $_POST['biaya_tkl'];

  $hasil= mysqli_query($h, "INSERT INTO produksi(tanggal_selesai, produk_id, jml_produksi, biaya_tkl)
  values('$tanggal_selesai', '$produk_id', '$jml_produksi', '$biaya_tkl')");
  if($hasil){
    // window.location='index.php?page=daftarproduksi'
    $q_prod = mysqli_query($h, "SELECT * from produksi ORDER BY no_produksi DESC");
    $prod = mysqli_fetch_assoc($q_prod);
    // echo "index.php?page=editproduksi&done=false&id='".$prod['no_produksi'];
    echo "
    <script>
    window.alert('Berhasil menambahkan data produksi');
    window.location='index.php?page=editproduksi&done=false&id=".$prod['no_produksi']."'
    </script>";
  }else{
    echo "
    <script>
    window.alert('Gagal menambah produksi karena ".mysqli_error($h)."'');
    </script>";
    // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
  }
}
?>
