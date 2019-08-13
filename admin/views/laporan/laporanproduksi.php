<div class="dashboard-ecommerce" style="
min-height: 565px;">
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
                        <td width="125"><b>Dari Tanggal</b></td>
                        <td colspan="2" width="190">: <input type="date" name="tanggal_awal" size="16" />
                        </td>
                        <td width="125"><b>Sampai Tanggal</b></td>
                        <td colspan="2" width="190">: <input type="date" name="tanggal_akhir" size="16" />
                        </td>
                        <td colspan="2" width="190"><input type="submit" value="Cari Data" name="pencarian"/></td>
                        <td colspan="2" width="70"><input type="reset" value="Reset" /></td>
                      </tr>
                    </table>
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
          document.location='index.php?page=laporanproduksi';
        </script>
        <?php
      }else{
        ?><i><b>Informasi : </b> Hasil pencarian data berdasarkan periode Tanggal <b><?php echo $_POST['tanggal_awal']?></b> s/d <b><?php echo $_POST['tanggal_akhir']?></b></i>
        <?php
        $query=mysql_query("select * from produksi where tgl_masuk between '$tanggal_awal' and '$tanggal_akhir'");
      }
      ?>
    </p>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table">
              <thead class="bg-light">
                <tr class="border-0">
                  <th class="border-0 centerHorizontal" style="width:20px">No</th>
                  <th class="border-0">Tanggal Selesai Produksi</th>
                  <th class="border-0">Nama Produk</th>
                  <th class="border-0">Jumlah Produksi</th>
                  <th class="border-0">Biaya Bahan</th>
                  <th class="border-0">Biaya tkl</th>
                  <th class="border-0">Biaya produksi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>


    <?php
    //menampilkan pencarian data
    while($row=mysql_fetch_array($query)){
      ?>
      <tr>
        <td align="center" height="30"><?php echo $row['tanggal_selesai']; ?></td>
        <td align="center"><?php echo $row['jml_produksi']; ?></td>
        <td align="center"><?php echo $row['biaya_bahan'];?></td>
        <td align="center"><?php echo $row['biaya_tkl'];?></td>
        <td align="center"><?php echo $row['biaya_produksi'];?></td>
      </tr>
      <?php
    }
    ?>
    <tr>
      <td colspan="4" align="center">
        <?php
        //jika pencarian data tidak ditemukan
        if(mysql_num_rows($query)==0){
          echo "<font color=red><blink>Pencarian data tidak ditemukan!</blink></font>";
        }
        ?>
      </td>
    </tr>
  </table>
  <?php
}
else{
  unset($_POST['pencarian']);
}
?>
<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
