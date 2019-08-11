
<?php
  $iddata=$_GET['id'];
  $hasil=mysqli_query($h, "SELECT * from produk where produk_id = '$iddata'");
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
          <h2 class="pageheader-title">Edit produk</h2>
          <p class="pageheader-text"></p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">produk</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $row["nama_produk"];  ?></li>
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
                  <input required name="nama" id="inputText3" type="text" class="form-control" value="<?php echo $row['nama_produk'];  ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Deskripsi</label>
                  <textarea required name="deskripsi" class="form-control" id="editor1" rows="3"><?php echo $row['deskripsi'];  ?></textarea>
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Harga</label>
                  <input required name="harga" type="number" step="any" class="form-control" value="<?php echo $row['harga'];  ?>" >
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Stok</label>
                  <input required name="stok" type="number" step="any" class="form-control" value="<?php echo $row['stok'];  ?>" >
                </div>

                <div class="form-group">Laba</label>
                  <input required name="laba" type="text" class="form-control" value="<?php echo $row['laba'];  ?>">
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
                  <input name="foto" type="file" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Ubah gambar produk</label>
                </div>
                <div class="w-12">
                  <img src="data/photos/<?php echo $row['gambar'];?>" alt="<?php echo $row['gambar'];?>" class="rounded" width="80">
                </div> -->
                <div class="custom-file mb-3">
                  <input type="submit" class="col-xl-4 centerHorizontal btn btn-primary" value="Ubah"></a>
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
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $laba = $_POST['laba'];
    $kategori_id = $_POST['kategori_id'];

    if(!empty($_FILES["foto"]["name"])){
      $name_before = "data/photos/".$row['gambar'];
      if (file_exists($name_before)) {
        chmod($name_before,0777);
	      unlink($name_before);
      }

      $namaFile = $_FILES["foto"]["name"];
      $tmp_file = $_FILES['foto']['tmp_name'];
      $path = "data/photos/".$namaFile;
      move_uploaded_file($tmp_file, $path);
      $hasil = mysqli_query($h, "UPDATE produk SET nama_produk = '".$nama."', deskripsi = '".$deskripsi."', harga = '".$harga."', stok = '".$stok."', laba = '".$laba."', kategori_id = '".$kategori_id."', gambar = '".$namaFile."' WHERE produk_id= ".$id);
    }else {
      $hasil = mysqli_query($h, "UPDATE produk SET nama_produk = '".$nama."', deskripsi = '".$deskripsi."', harga = '".$harga."', stok = '".$stok."', laba = '".$laba."', kategori_id = '".$kategori_id."' WHERE produk_id= ".$id);
    }
    // echo $hasil;
    if($hasil){
        echo "
        <script>
          window.alert('Berhasil mengupdate data produk');
          window.location='index.php?page=daftarproduk';
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }else{
        echo "UPDATE produk SET nama_produk = '".$nama."', deskripsi = '".$deskripsi."', harga = '".$harga."', stok = '".$stok."', laba = '".$laba."', kategori_id = '".$kategori_id."', gambar = '".$namaFile."' WHERE produk_id= ".$id;
        echo "Gagal menambah produk karena ".mysqli_error($h);
        // echo "
        // <script>
        //   window.alert('Gagal menambah produk karena ".mysqli_error($h)."'');
        // </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
  }
?>
