<?php
$produk = mysqli_query($h, "SELECT * from produk");
?>
<div class="dashboard-ecommerce" style="min-height:88vh">
<div class="container-fluid dashboard-content ">
  <!-- ============================================================== -->
  <!-- pageheader  -->
  <!-- ============================================================== -->
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="page-header">
        <h2 class="pageheader-title">Laporan Produksi</h2>
        <div class="page-breadcrumb">
          <div class="ecommerce-widget">
            <div class="row">
              <!-- ============================================================== -->

              <!-- ============================================================== -->

              <!-- recent orders  -->
              <!-- ============================================================== -->
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-responsive">
                  <form action="index.php?page=laporanproduksi" method="post" name="postform">
                    <table class="table">
                      <tr>
                        <td width="50"><b>Dari Tanggal</b></td>
                        <td width="80"><input class="form-control" type="date" name="tanggal_awal" size="16" />
                        </td>
                        <td width="50"><b>Sampai Tanggal</b></td>
                        <td width="80"><input class="form-control" type="date" name="tanggal_akhir" size="16" />
                        </td>
                      </tr>
                      <tr>
                        <td width="50"><b>Nama Produk</b></td>
                        <td width="80">
                          <select name="produk_id" class="form-control">
                                              <?php
                                              while($prod = $produk->fetch_array()){
                                                ?>
                                                    <option value="<?= $prod['produk_id'] ?>">
                                                      <?= $prod['nama_produk'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                        </td>
                      </tr>
                    </table>
                    <div class="col-md-12" style="margin-top:20px">
                      <input class="btn btn-outline-info" type="submit" value="Cari Data" name="pencarian"/>
                      <!-- <input class="btn btn-outline-danger" type="reset" value="Reset" /> -->
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
      $tanggal_awal = $_POST['tanggal_awal'];
      $tanggal_akhir = $_POST['tanggal_akhir'];
      $produk_id = $_POST['produk_id'];
      if(empty($tanggal_awal) || empty($tanggal_akhir)){
        ?>
        <script language="JavaScript">
          alert('Tanggal Awal dan Tanggal Akhir Harap di Isi!');
          document.location='index.php?page=laporanproduksi';
        </script>
        <?php
      }else{
        ?><i><b>Informasi : </b> Hasil pencarian data berdasarkan periode Tanggal <b><?php echo parseTanggal($_POST['tanggal_awal'])?></b> s/d <b><?php echo parseTanggal($_POST['tanggal_akhir'])?></b></i>
        <?php
        $query = mysqli_query($h, "SELECT * from produksi
                                    JOIN produk ON produk.produk_id = produksi.produk_id
                                    where produk.produk_id = '$produk_id'
                                    AND tanggal_selesai BETWEEN '$tanggal_awal'
                                    AND '$tanggal_akhir'");
      }
      ?>
    </p>
    <div class="col-md-12">
      <?php
      if(mysqli_num_rows($query) > 0){
        ?>
        <a target="_blank" href="<?= 'laporan/LaporanProduksi.php?first_date='.$tanggal_awal.'&last_date='.$tanggal_akhir.'&produk_id='.$produk_id ?>" class="btn btn-primary">Unduh Laporan</a>
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
                  <th class="text-center">Tanggal Selesai Produksi</th>
                  <th class="text-center">Nama Produk</th>
                  <th class="text-center">Jumlah Produksi</th>
                  <th class="border-0 text-center">Biaya produksi</th>
                  <?php if(helper(3, $account->id_level)){ ?>
                    <th class="text-center">Faktur</th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>
    <?php
    //menampilkan pencarian data
    $no = 0;
    while($row = $query->fetch_array()){
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
      <tr class="border-0">
        <td class="text-center" style="width:20px"><?= $no ?></td>
        <td align="center" height="30"><?php echo parseTanggal($row['tanggal_selesai']); ?></td>
        <td align="center"><?php echo $row['nama_produk']; ?></td>
        <td align="center"><?php echo $row['jml_produksi']; ?></td>
        <td align="center">
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
        <?php if(helper(3, $account->id_level)){ ?>
          <td class="text-center">
            <a target="_blank" href="<?= 'laporan/FakturProduksi.php?no_produksi='.$row['no_produksi'] ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
          </td>
        <?php } ?>
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
