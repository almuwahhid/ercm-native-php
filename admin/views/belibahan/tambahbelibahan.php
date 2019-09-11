<?php
  $hasil=mysqli_query($h, "SELECT * from purchase_bahan where id = 'id'");
  $row = mysqli_fetch_assoc($hasil);

  $id_supply = $row['supplier_id'];
  $supply = mysqli_query($h, "SELECT * from supplier");

  $id_produksi = $row['no_produksi'];
  $produksy = mysqli_query($h, "SELECT * from produksi");
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
                  <label for="inputText3" class="col-form-label">Tanggal Pembelian Bahan</label>
                  <input required name="tanggal" id="inputText3" type="date" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Jumlah KBP</label>
                  <input required name="jml_kbp" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Biaya Bahan</label>
                  <input required name="biaya_bahan" type="text" step="any" class="form-control">
                </div>

                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Tanggal Selesai Produksi</label>
                  <select name="supplier_id" class="form-control">
                                      <?php
                                      while($pro = $produksy->fetch_array()){
                                        ?>
                                            <option value="<?= $pro['no_produksi'] ?>"
                                              <?php if($pro['no_produksi'] == $row['no_produksi']) echo "selected"; ?> >
                                              <?= $pro['tanggal_selesai'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                  </div>

                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Nama Supplier</label>
                  <select name="supplier_id" class="form-control">
                                      <?php
                                      while($sup = $supply->fetch_array()){
                                        ?>
                                            <option value="<?= $sup['supplier_id'] ?>"
                                              <?php if($sup['supplier_id'] == $row['supplier_id']) echo "selected"; ?> >
                                              <?= $sup['nama'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
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
    $jml_kbp = $_POST['jml_kbp'];
    $biaya_bahan = $_POST['biaya_bahan'];
    $no_produksi = $_POST['no_produksi'];
    $supplier_id = $_POST['supplier_id'];

    $hasil= mysqli_query($h, "INSERT INTO purchase_bahan(tanggal, jml_kbp, biaya_bahan, no_produksi, supplier_id)
                              values('$tanggal','$jml_kbp', '$biaya_bahan', '$no_produksi', '$supplier_id')");
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
