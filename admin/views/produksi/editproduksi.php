<?php
  if(isset($_GET['id'])){
    $iddata = $_GET['id'];
    $done = ($_GET['done'] == "true" ? true : false);
    $hasil=mysqli_query($h, "SELECT * from produksi where no_produksi = '$iddata'");
    $datas = mysqli_fetch_assoc($hasil);

    $id_produk = $datas['produk_id'];
    $produk = mysqli_query($h, "SELECT * from produk");

    $allbahan = mysqli_query($h, "SELECT * from bahan");
    $databahan = mysqli_query($h, "SELECT * from bahan_produksi
      JOIN bahan ON bahan.bahan_id = bahan_produksi.id_bahan
      where id_produksi = '$iddata'");

    $databahan2 = mysqli_query($h, "SELECT * from bahan_produksi
        JOIN bahan ON bahan.bahan_id = bahan_produksi.id_bahan
        where id_produksi = '$iddata'");

    $jumlah_bahan = mysqli_num_rows(mysqli_query($h, "SELECT * from bahan_produksi WHERE id_produksi = ".$iddata));
  } else if(isset($_GET['delete'])){
    $iddata = $_GET['delete'];
    $idprod = $_GET['idprod'];
    $del = mysqli_query($h,"DELETE FROM bahan_produksi WHERE id_bahan_produksi = '$iddata'");
    if ($del) {
      echo "
      <script>
        window.alert('Berhasil menghapus bahan produksi');
        window.location='index.php?page=editproduksi&done=false&id=".$idprod."';
      </script>";
    }else {
      ?>
      <script language="javascript">
      alert ("Bahan produksi gagal dihapus");
      document.location="index.php?page=editproduksi&done=false&id=<?= $idprod ?>";
      </script>
      <?php
    }
  }
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
                <li class="breadcrumb-item"><a href="index.php?page=daftarproduksi" class="breadcrumb-link">Produksi</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo parseTanggal($datas["tanggal_selesai"]);  ?></li>
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
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
          <div class="tab-regular">
            <ul class="nav nav-tabs " id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail Produksi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Bahan Produksi</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                <?php
                  include('detailproduksi.php');
                 ?>
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <?php
                  include('bahanproduksi.php');
                 ?>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
