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
        $query = mysqli_query($h, "SELECT * from produksi JOIN produk ON produk.produk_id = produksi.produk_id where produk.produk_id = '$produk_id' AND tanggal_selesai BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
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
                  <th class="text-center">Biaya Bahan</th>
                  <th class="text-center">Biaya tkl</th>
                  <th class="text-center">Biaya produksi</th>
                </tr>
                </thead>
                <tbody>
    <?php
    //menampilkan pencarian data
    $no = 0;
    while($row = $query->fetch_array()){
      $no++;
      ?>
      <tr class="border-0">
        <td class="text-center" style="width:20px"><?= $no ?></td>
        <td align="center" height="30"><?php echo parseTanggal($row['tanggal_selesai']); ?></td>
        <td align="center"><?php echo $row['nama_produk']; ?></td>
        <td align="center"><?php echo $row['jml_produksi']; ?></td>
        <td align="center"><?php echo 'Rp.'.number_format($row['biaya_bahan'],2,',','.');?></td>
        <td align="center"><?php echo 'Rp.'.number_format($row['biaya_tkl'],2,',','.');?></td>
        <td align="center"><?php echo 'Rp.'.number_format($row['biaya_produksi'],2,',','.');?></td>
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
