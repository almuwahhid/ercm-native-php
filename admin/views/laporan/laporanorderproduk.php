<?php
$produk = mysqli_query($h, "SELECT * from orderan");
?>
<div class="dashboard-ecommerce" style="min-height:88vh">
<div class="container-fluid dashboard-content ">
  <!-- ============================================================== -->
  <!-- pageheader  -->
  <!-- ============================================================== -->
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="page-header">
        <h2 class="pageheader-title">Laporan Order Produk</h2>
        <div class="page-breadcrumb">
          <div class="ecommerce-widget">
            <div class="row">
              <!-- ============================================================== -->

              <!-- ============================================================== -->

              <!-- recent orders  -->
              <!-- ============================================================== -->
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-responsive">
                  <form action="index.php?page=laporanorderproduk" method="post" name="postform">
                    <table class="table">
                      <tr>
                        <td width="50"><b>Dari Tanggal</b></td>
                        <td width="80"><input class="form-control" type="date" name="tanggal_awal" size="16" />
                        </td>
                        <td width="50"><b>Sampai Tanggal</b></td>
                        <td width="80"><input class="form-control" type="date" name="tanggal_akhir" size="16" />
                        </td>
                      </tr>
                    </table>
                    <div class="col-md-12" style="margin-top:20px">
                      <input class="btn btn-outline-info" type="submit" value="Cari Data" name="pencarian"/>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <p>
    <?php
    //proses jika sudah klik tombol pencarian data
    if(isset($_POST['pencarian'])){
      //menangkap nilai form
      $tanggal_awal=$_POST['tanggal_awal'];
      $tanggal_akhir=$_POST['tanggal_akhir'];
      if(empty($tanggal_awal) || empty($tanggal_akhir)){
        //jika data tanggal kosong
        ?>
        <script language="JavaScript">
          alert('Tanggal Awal dan Tanggal Akhir Harap di Isi!');
          document.location='index.php?page=laporanorderproduk';
        </script>
        <?php
      }else{
        ?><i><b>Informasi : </b> Hasil pencarian data berdasarkan periode Tanggal <b><?php echo parseTanggal($_POST['tanggal_awal'])?></b> s/d <b><?php echo parseTanggal($_POST['tanggal_akhir'])?></b></i>
        <?php
        $query = mysqli_query($h, "SELECT * from orderan JOIN customers ON orderan.customers_id = customers.customers_id where tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
      }
      ?>
    </p>
    <div class="col-md-12">
      <?php
      if(mysqli_num_rows($query) > 0){
        ?>
        <a target="_blank" href="<?= 'laporan/LaporanOrderProduk.php?first_date='.$tanggal_awal.'&last_date='.$tanggal_akhir ?>" class="btn btn-primary">Unduh Laporan</a>
        <?php
        }
       ?>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead class="bg-light">
                <tr class="border-0">
                  <th class="text-center" style="width:20px">No</th>
                  <th class="text-center">Nama Customer</th>
                  <th class="text-center">Tanggal</th>
                  <th class="text-center">Produk</th>
                  <th class="text-center">Harga</th>
                  <th class="text-center">Jumlah</th>
                  <th class="text-center">Subtotal</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Total Laba</th>
                </tr>
                </thead>
                <tbody>
    <?php
    //menampilkan pencarian data
    $no = 0;
    while($row = $query->fetch_array()){
      $no++;
      $id_detail_order = $row['no_order'];
      $query_order_detail = mysqli_query($h, "SELECT * from order_detail
                                        JOIN orderan ON order_detail.no_order = orderan.no_order
                                        JOIN produk ON order_detail.produk_id = produk.produk_id
                                        WHERE orderan.no_order = '$id_detail_order'
                                        ORDER BY order_detail.hrg_jual ASC");
     $query_order_detail2 = mysqli_query($h, "SELECT * from order_detail
                                  JOIN orderan ON order_detail.no_order = orderan.no_order
                                  JOIN produk ON order_detail.produk_id = produk.produk_id
                                  WHERE orderan.no_order = '$id_detail_order'
                                  ORDER BY order_detail.hrg_jual ASC");
      $total = 0;
      $totalLaba = 0;
      while($rows = $query_order_detail->fetch_array()){
          $total += $rows['subtotal'];
          $totalLaba += ($rows['laba'] * $rows['jumlah']);
      }
      $jumlah = mysqli_num_rows(mysqli_query($h, "SELECT * from order_detail
                                        JOIN orderan ON order_detail.no_order = orderan.no_order
                                        JOIN produk ON order_detail.produk_id = produk.produk_id
                                        WHERE orderan.no_order = '$id_detail_order'
                                        ORDER BY order_detail.hrg_jual ASC"));
      $kolom = 0;
      while($rows = $query_order_detail2->fetch_array()){
        echo '<tr class="border-0">';
        if($kolom == 0){
          ?>
          <td rowspan="<?= $jumlah ?>" class="text-center" style="width:20px"><?= $no ?></td>
          <td rowspan="<?= $jumlah ?>" align="center"><?php echo $row['nama']; ?></td>
          <td rowspan="<?= $jumlah ?>" align="center" height="30"><?php echo parseTanggal($row['tanggal']); ?></td>
          <?php
        }
          ?>
          <td class="text-center">
            <?php echo $rows['nama_produk'];?>
          </td>
          <td class="text-center">
            Rp. <?= number_format($rows['hrg_jual'],2,',','.')?>
          </td>
          <td class="text-center">
            <?php echo $rows['jumlah'];?>
          </td>
          <td class="text-center">
            Rp. <?= number_format($rows['subtotal'],2,',','.')?>
          </td>
          <?php
          if($kolom == 0){
            $kolom = 1;
            ?>
            <td rowspan="<?= $jumlah ?>" class="text-center">
              Rp. <?= number_format($total,2,',','.')?>
            </td>
            <td rowspan="<?= $jumlah ?>" class="text-center">
              Rp. <?= number_format($totalLaba,2,',','.')?>
            </td>
            <?php
          }
      }
      ?>
      </tr>
      <?php
    }
    ?>
    <tr>
      <td colspan="7" align="center">
        <?php
        //jika pencarian data tidak ditemukan
        if(mysqli_num_rows($query)==0){
          echo "<font color=red><blink>Pencarian data tidak ditemukan!</blink></font>";
        }
        ?>
      </td>
    </tr>
  </tbody>

</table>
</div>
</div>
</div>
</div>
  <?php
}
else{
  unset($_POST['pencarian']);
}
?>
<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</div>
</div>
