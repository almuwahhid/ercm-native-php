<?php
  $hasil=mysqli_query($h, "SELECT * from produk where produk_id = 'id'");
  $row = mysqli_fetch_assoc($hasil);

  $id_supply = $row['kategori_id'];
  $supply = mysqli_query($h, "SELECT * from kategori");

?>

<div class="dashboard-ecommerce">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Tambah Produk </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
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
                <input name="id" type="hidden" class="form-control" value="<?php echo $row['produk_id'];  ?>">
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Nama produk</label>
                  <input required name="nama" id="inputText3" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Deskripsi</label>
                  <textarea required name="deskripsi" id="editor1" type="text" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Harga</label>
                  <input required name="harga" type="number" step="any" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Stok</label>
                  <input required name="stok" type="number" step="any" class="form-control">
                </div>

                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Laba</label>
                  <input required name="laba" type="number" step="any" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Kategori Produk</label>
                  <select name="kategori_id" class="form-control">
                                      <?php
                                      while($sup = $supply->fetch_array()){
                                        ?>
                                            <option value="<?= $sup['kategori_id'] ?>"
                                              <?php if($sup['kategori_id'] == $row['kategori_id']) echo "selected"; ?> >
                                              <?= $sup['nama_kategori'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                  </div>
                <div class="custom-file mb-3">
                  <input required name="foto" type="file" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Masukkan gambar produk</label>
                </div>
                <div class="custom-file mb-3">
                  <input type="submit" class="centerHorizontal btn btn-primary" value="Tambahkan"></a>
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
  if(isset($_POST['nama']) && !empty($_FILES["foto"]["name"])){
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $laba = $_POST['laba'];
    $kategori_id = $_POST['kategori_id'];


    $namaFile = $_FILES["foto"]["name"];
    $tmp_file = $_FILES['foto']['tmp_name'];
    $path = "data/photos/".$namaFile;
    move_uploaded_file($tmp_file, $path);

    $hasil= mysqli_query($h, "INSERT INTO produk(nama_produk, deskripsi, harga, stok, laba, gambar, kategori_id)
                              values('$nama','$deskripsi', '$harga', '$stok', '$laba', '$namaFile', '$kategori_id')");
    if($hasil){
      echo "hei";
        echo "
        <script>
          window.alert('Berhasil menambahkan data produk');
          window.location='index.php?page=daftarproduk'
        </script>";
      }else{
        echo "Gagal menambah produk karena ".mysqli_error($h);
        echo "
        <script>
          window.alert('Gagal menambah produk karena ".mysqli_error($h)."'');
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
  }
?>
