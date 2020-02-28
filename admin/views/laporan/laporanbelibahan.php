<?php
$produk = mysqli_query($h, "SELECT * from purchase_bahan");
?>
<div class="dashboard-ecommerce" style="min-height:88vh">
<div class="container-fluid dashboard-content ">
  <!-- ============================================================== -->
  <!-- pageheader  -->
  <!-- ============================================================== -->
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="page-header">
        <h2 class="pageheader-title">Laporan Pembelian Bahan</h2>
        <div class="page-breadcrumb">
          <div class="ecommerce-widget">
            <div class="row">
              <!-- ============================================================== -->

              <!-- ============================================================== -->

              <!-- recent orders  -->
              <!-- ============================================================== -->
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-responsive">
                  <form action="index.php?page=laporanbelibahan" method="post" name="postform">
                    <table class="table">
                      <tr>
                        <td width="50"><b>Dari Tanggal</b></td>
                        <td width="80"><input class="form-control" type="date" name="tanggal_awal" size="16" />
                        </td>
                        <td width="50"><b>Sampai Tanggal</b></td>
                        <td width="80"><input class="form-control" type="date" name="tanggal_akhir" size="16" />
                        </td>
                      </tr>
                      <!-- <tr>
                        <td width="50"><b>Jumlah KBP</b></td>
                        <td width="80">
                          <select name="id" class="form-control">
                                              <?php
                                              while($prod = $produk->fetch_array()){
                                                ?>
                                                    <option value="<?= $prod['id'] ?>">
                                                      <?= $prod['jml_kbp'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                        </td>
                      </tr> -->
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
      // $id = $_POST['id'];
      if(empty($tanggal_awal) || empty($tanggal_akhir)){
        //jika data tanggal kosong
        ?>
        <script language="JavaScript">
          alert('Tanggal Awal dan Tanggal Akhir Harap di Isi!');
          document.location='index.php?page=laporanbelibahan';
        </script>
        <?php
      }else{
        ?><i><b>Informasi : </b> Hasil pencarian data berdasarkan periode Tanggal <b><?php echo parseTanggal($_POST['tanggal_awal'])?></b> s/d <b><?php echo parseTanggal($_POST['tanggal_akhir'])?></b></i>
        <?php
        if(helper(4, $account->id_level)){
          $query = mysqli_query($h, "SELECT * from purchase_bahan
                                            JOIN bahan ON purchase_bahan.bahan_id = bahan.bahan_id
                                            JOIN supplier ON bahan.supplier_id = supplier.supplier_id
                                            WHERE supplier.supplier_id = $account->supplier_id AND tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        } else {
          $query = mysqli_query($h, "SELECT * from purchase_bahan
                                            JOIN bahan ON purchase_bahan.bahan_id = bahan.bahan_id
                                            JOIN supplier ON bahan.supplier_id = supplier.supplier_id
                                            WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        }

      }
      ?>
    </p>
    <div class="col-md-12">
      <?php
      if(mysqli_num_rows($query) > 0){
        ?>
        <a target="_blank" href="<?= 'laporan/LaporanPembelianBahan.php?first_date='.$tanggal_awal.'&last_date='.$tanggal_akhir ?>" class="btn btn-primary">Unduh Laporan</a>
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
                  <th class="text-center border-0">Tanggal Pembelian Bahan</th>
                  <th class="text-center border-0">Bahan</th>
                  <th class="text-center border-0">Supplier</th>
                  <th class="text-center border-0">Jumlah Pembelian</th>
                  <th class="text-center border-0">Total Biaya</th>
                  <th class="text-center border-0">Status</th>
                  <?php
                  if(helper(4, $account->id_level)){
                    ?>
                    <th class="text-center  border-0">Faktur</th>
                    <?php
                  }
                  ?>
                </tr>
                </thead>
                <tbody>
    <?php
    //menampilkan pencarian data
    $no = 0;
    $colspan = 7;
    while($row = $query->fetch_array()){
      $no++;
      ?>
      <tr class="border-0">
        <td align="center">
          <?php echo $no;?>
        </td>
        <td align="center">
          <?php echo parseTanggal($row['tanggal']);?>
        </td>
        <td align="center">
          <?php echo $row['nama_bahan'];?>
        </td>
        <td align="center">
          <?php echo $row['nama'];?>
        </td>
        <td align="center">
          <?php echo $row['jml_kbp'];?>
        </td>
        <td align="center">
          <?php echo 'Rp.'.number_format(($row['jml_kbp']*$row['harga']),2,',','.');?>
        </td>
        <td align="center">
          <?php
        if($row['confirmed'] == ""){
          echo '<i style="color:green" class="fas fa-check-circle"></i>';
        }else {
          echo '<i style="color:grey" class="fas fa-window-close"></i>';
        }
        ?>
        </td>
        <?php
        if(helper(4, $account->id_level)){
          $colspan = 8;
          ?>
            <td align="center">
            <a href="<?= 'laporan/FakturPembelianBahan.php?id='.$row['id']?>" target="_blank">
              <i class="fas fa-print"></i>
            </a>
          </td>
          <?php
        }?>
      </tr>
      <?php
    }
    ?>
    <tr>
      <td colspan="<?= $colspan ?>" align="center">
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
