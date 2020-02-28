<?php
$query_purchase_bahan = mysqli_query($h, "SELECT * from purchase_bahan
                                  JOIN bahan ON purchase_bahan.bahan_id = bahan.bahan_id
                                  JOIN supplier ON bahan.supplier_id = supplier.supplier_id
                                  WHERE supplier.supplier_id = ".$account->supplier_id."
                                  ORDER BY purchase_bahan.tanggal ASC");
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
          <h2 class="pageheader-title">Daftar Pembelian Bahan</h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pembelian Bahan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Pembelian Bahan</li>
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
            <h5 class="card-header">Pembelian Bahan yang sudah ditambahkan</h5>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">
                      <th class="text-center border-0 centerHorizontal" style="width:20px">No</th>
                      <th class="text-center border-0">Tanggal Pembelian Bahan</th>
                      <th class="text-center border-0">Bahan</th>
                      <th class="text-center border-0">Supplier</th>
                      <th class="text-center border-0">Jumlah Pembelian</th>
                      <th class="text-center border-0">Total Biaya</th>
                      <th class="text-center border-0">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0;
                    while($row = $query_purchase_bahan->fetch_array()){
                      $no++;
                      ?>
                      <tr>
                        <td class="centerHorizontal">
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
                        <td class="text-center">
                          <?php if($row['confirmed'] == ""){
                            ?>
                            <a href="#" onclick="hapusbelibahan('index.php?page=konfirmasibelibahan&id=<?php echo $row['id']; ?>')">
                              <i class="fas fa-check-square"></i> Konfirmasi
                            </a>
                            <?php
                          } else {
                            ?>
                            <i style="color:green" class="fas fa-check-circle"></i>
                            <?php
                          }?>
                        </td>
                      </tr>

                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $hasil = mysqli_query($h, "UPDATE purchase_bahan SET confirmed = 'Y' WHERE id = ".$id);
  if ($hasil) {
    ?>
    <script type="text/javascript">
    // alert("berhasil menghapus purchase_bahan");
    window.location.href="index.php?page=konfirmasibelibahan";
    </script>
    <?php
  }else {
    ?>
    <script language="javascript">
    alert ("Pembelian Bahan gagal dikonfirmasi"); document.location="index.php?page=konfirmasibelibahan";
    </script>
    <?php
  }
}
?>
<script>
function hapusbelibahan(url){
  var x = confirm("Apakah Anda ingin mengkonfirmasi Pembelian ini?");
  if(x){
    window.location.href = url;
  }
}
</script>
