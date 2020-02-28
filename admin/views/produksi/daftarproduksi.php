<?php
$jumlah = mysqli_num_rows(mysqli_query($h, "SELECT * from produksi"));
$banyak_data = floor($jumlah/5)+1;
$limit = 0;
if(isset($_GET["r"])){
  $active_list = $_GET["r"];
  $first = ($_GET["r"]*5);
  $limit = $first-5;
  $query_produksi = mysqli_query($h, "SELECT * from produksi
                                    JOIN produk ON produksi.produk_id = produk.produk_id
                                    ORDER BY produksi.tanggal_selesai ASC LIMIT 5 OFFSET ".$limit);
}else{
  if($banyak_data>1){
      $query_produksi = mysqli_query($h, "SELECT * from produksi
                                    JOIN produk ON produksi.produk_id = produk.produk_id
                                        ORDER BY produksi.tanggal_selesai ASC LIMIT 5");
    }else{
      $query_produksi = mysqli_query($h, "SELECT * from produksi
                                            JOIN produk ON produksi.produk_id = produk.produk_id
                                        ORDER BY produksi.tanggal_selesai ASC");
    }
}
if($query_produksi){
	$no = $limit;
}

?>
<div class="dashboard-ecommerce" style="
    min-height: 565px;">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Daftar Produksi</h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Produksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Produksi</li>
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
            <h5 class="card-header">Produksi yang sudah ditambahkan</h5>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">
                      <th class="border-0 text-center" style="width:20px">No</th>
                      <th class="border-0 text-center">Tanggal Selesai Produksi</th>
                      <th class="border-0 text-center">Nama Produk</th>
                      <th class="border-0 text-center">Jumlah Produksi</th>
                      <th class="border-0 text-center">Biaya produksi</th>

                      <th class="border-0 text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($row = $query_produksi->fetch_array()){
                      $no++;
                      $biayabahan = 0;
                      $iddata = $row['no_produksi'];
                      $jumlah_bahan = mysqli_num_rows(mysqli_query($h, "SELECT * from bahan_produksi
                                                                        JOIN produk ON produk.produk_id = bahan_produksi.id_produk
                                                                        JOIN produksi ON produksi.produk_id = produk.produk_id
                                                                        WHERE no_produksi = ".$iddata));

                      $databahan2 = mysqli_query($h, "SELECT * from bahan_produksi
                          JOIN bahan ON bahan.bahan_id = bahan_produksi.id_bahan
                          JOIN produk ON produk.produk_id = bahan_produksi.id_produk
                          JOIN produksi ON produksi.produk_id = produk.produk_id
                          where no_produksi = '$iddata'");
                      $dataproduk = mysqli_fetch_assoc(mysqli_query($h, "SELECT * from produk
                              JOIN produksi ON produk.produk_id = produksi.produk_id
                              where no_produksi = '$iddata'"));

                      if($jumlah_bahan > 0){
                        while($rows = $databahan2->fetch_array()){
                            $biayabahan = $biayabahan+($rows['jumlah']*$rows['harga']);
                        }
                      }
                      $biayabahan = $biayabahan+$dataproduk['biayaproduk'];
                      $biayabahan = $biayabahan*$row['jml_produksi'];

                      ?>

                      <tr>
                        <td class="text-center">
                          <?php echo $no;?>
                        </td>
                        <td class="text-center">
                          <?php echo parseTanggal($row['tanggal_selesai']);?>
                        </td>
                        <td class="text-center">
                          <?php echo $row['nama_produk'];?>
                        </td>
                        <td class="text-center">
                          <?php echo $row['jml_produksi'];?>
                        </td>
                        <td class="text-center">
                          <?php
                            if($biayabahan == 0){
                              echo "-";
                            } else {
                          ?>
                          Rp. <?= number_format($biayabahan,2,',','.')  ?>
                          <?php
                          }
                          ?>
                        </td>
                        <td class="text-center" style="width:100px">
                          <?php
                          if(date("Y-m-d") > $row['tanggal_selesai']){
                            ?>
                            <i style="color:green" class="fas fa-check-circle"></i> &nbsp;&nbsp;
                            <a href="index.php?page=editproduksi&done=true&id=<?php echo $row['no_produksi']?>">
                              <i class="fas fa-search"></i>
                            </a>
                            <?php
                          } else {
                            ?>
                            <a href="index.php?page=editproduksi&done=false&id=<?php echo $row['no_produksi']?>">
                              <i class="fas fa-edit"></i>
                            </a> &nbsp;&nbsp;
                            <a href="#" onclick="hapusproduksi('index.php?page=daftarproduksi&delete=<?php echo $row['no_produksi']; ?>')">
                              <i class="fas fa-trash"></i>
                            </a>
                            <?php
                          }
                          ?>
                        </td>
                      </tr>

                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="col-md-12">
                <nav aria-label="Page navigation">
                  <ul class="pagination">
                    <?php
                    if($banyak_data>1){
                      for($i=1;$i<=$banyak_data;$i++){
                        if(isset($active_list)){
                          if($active_list==$i){
                            echo '<li class="page-item active"><a class="page-link">'.$i.'</a></li>';
                          }else{
                            echo "<li class='page-item'><a class='page-link' href='index.php?page=daftarproduksi&r=".$i."'>".$i."</a></li>";
                          }
                        }else{
                          if($i==1){
                            echo '<li class="active page-item"><a class="page-link">'.$i.'</a></li>';
                          }else{
                            echo "<li class='page-item'><a class='page-link' href='index.php?page=daftarproduksi&r=".$i."'>".$i."</a></li>";
                          }
                        }
                      }
                    }
                    ?>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_GET['delete'])) {
  $id=$_GET['delete'];
  $del=mysqli_query($h,"DELETE FROM produksi WHERE no_produksi = '$id'");
  if ($del) {
    ?>
    <script type="text/javascript">
    // alert("berhasil menghapus produksi");
    window.location.href="index.php?page=daftarproduksi";
    </script>
    <?php
  }else {
    ?>
    <script language="javascript">
    alert ("produksi gagal Di Hapus"); document.location="index.php?page=daftarproduksi";
    </script>
    <?php
  }
}
?>
<script>
function hapusproduksi(url){
  var x = confirm("Apakah Anda ingin menghapus data ini?");
  if(x){
    window.location.href = url;
  }
}
</script>
