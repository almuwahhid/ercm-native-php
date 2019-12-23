
<?php
  $iddata=$_GET['id'];
  $hasil=mysqli_query($h, "SELECT * from produksi_jadwal where jadwal_id = '$iddata'");
  $row = mysqli_fetch_assoc($hasil);

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
          <h2 class="pageheader-title">Edit Jadwal Produksi</h2>
          <p class="pageheader-text"></p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?page=daftarjadwal" class="breadcrumb-link">Jadwal Produksi</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo parseTanggal($row["tanggal"]);  ?></li>
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
                <input name="id" type="hidden" class="form-control" value="<?php echo $row['jadwal_id'];  ?>">
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Tanggal Produksi</label>
                  <input required name="tanggal" id="inputText3" type="date" class="form-control" value="<?php echo $row['tanggal'];  ?>">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Kapasitas Produksi</label>
                  <input required name="kapasitas_produksi" type="text" class="form-control" value="<?php echo $row['kapasitas_produksi'];  ?>">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Tanggal Selesai Produksi</label>
                  <select name="no_produksi" class="form-control">
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
  if(isset($_POST['tanggal'])){
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $kapasitas_produksi = $_POST['kapasitas_produksi'];
    $no_produksi = $_POST['no_produksi'];


      $hasil = mysqli_query($h, "UPDATE produksi_jadwal SET tanggal = '".$tanggal."', kapasitas_produksi = '".$kapasitas_produksi."', no_produksi = '".$no_produksi."' WHERE jadwal_id= ".$id);

    if($hasil){
        echo "
        <script>
          window.alert('Berhasil mengupdate data Jadwal Produksi');
          window.location='index.php?page=daftarjadwal';
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }else{
        echo "
        <script>
          window.alert('Gagal menambah Jadwal Produksi karena ".mysqli_error($h)."'');
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
  }

?>
