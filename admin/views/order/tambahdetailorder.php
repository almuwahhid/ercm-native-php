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
          <h2 class="pageheader-title">Tambah Detail Order</h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?page=daftarkirimbahan" class="breadcrumb-link">Detail Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Detail Order</li>
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
                  <label for="inputText3" class="col-form-label">Harga Jual</label>
                  <input required name="hrg_jual" id="inputText3" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Jumlah</label>
                  <input required name="jumlah" type="number" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Subtotal</label>
                  <input required name="subtotal" type="text" class="form-control">
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

  if(isset($_POST['hrg_jual'])){
    $hrg_jual = $_POST['hrg_jual'];
    $jumlah = $_POST['jumlah'];
    $subtotal = $_POST['subtotal'];
    $produk_id = $_POST['produk_id'];

    $hasil= mysqli_query($h, "INSERT INTO order_detail(hrg_jual, jumlah, subtotal, produk_id)
                              values('$hrg_jual','$jumlah', '$subtotal', '$produk_id')");
    if($hasil){
        echo "
        <script>
          window.alert('Berhasil menambahkan data Detail Order');
          window.location='index.php?page=detailorder'
        </script>";
      }else{
        echo "
        <script>
          window.alert('Gagal menambah Detail Order karena ".mysqli_error($h)."'');
        </script>";
        echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
}
?>
