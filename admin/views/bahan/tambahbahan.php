<?php
  $hasil=mysqli_query($h, "SELECT * from bahan where bahan_id = 'id'");
  $row = mysqli_fetch_assoc($hasil);

  $id_supply = $row['supplier_id'];
  $supply = mysqli_query($h, "SELECT * from supplier");
?>

<div class="dashboard-ecommerce">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Tambah Bahan</h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Bahan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Bahan</li>
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
                <input name="id" type="hidden" class="form-control" value="<?php echo $row['bahan_id'];  ?>">
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Nama Bahan</label>
                  <input required name="nama" id="inputText3" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Satuan</label>
                  <input required name="satuan" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Harga</label>
                  <input required name="harga" type="number" step="any" class="form-control">
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

  if(isset($_POST['nama'])){
    $nama = $_POST['nama'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];
    $supplier_id = $_POST['supplier_id'];

    $hasil= mysqli_query($h, "INSERT INTO bahan(nama_bahan, satuan, harga, supplier_id)
                              values('$nama','$satuan', '$harga', '$supplier_id')");
    if($hasil){
        echo "
        <script>
          window.alert('Berhasil menambahkan data bahan');
          window.location='index.php?page=daftarbahan'
        </script>";
      }else{
        echo "
        <script>
          window.alert('Gagal menambah bahan karena ".mysqli_error($h)."'');
        </script>";
        echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
}
?>
