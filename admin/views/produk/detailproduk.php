<?php
  $iddata=$_GET['id'];
  $hasil=mysqli_query($h, "SELECT * from produk where produk_id = '$iddata'");
  $row = mysqli_fetch_assoc($hasil);
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
          <h2 class="pageheader-title">Daftar Produk </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
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
            <h5 class="card-header">Produk yang sudah ditambahkan</h5>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">

                      <th class="border-0">Nama Produk</th>
                      <th class="border-0">Gambar</th>
                      <th class="border-0">Deskripsi</th>
                      <th class="border-0">Harga</th>
                      <th class="border-0">Stok</th>
                      <th class="border-0">Laba</th>
                      <?php
                      if(helper(3, $account->id_level)){
                       ?>
                      <th class="border-0">Aksi</th>
                    <?php
                    }
                    ?>
                    </tr>
                  </thead>
                  <tbody>

                        <td>
                          <?php echo $row['nama_produk'];?>
                        </td>
                        <td>
                          <div class="m-r-10"><img src="data/photos/<?php echo $row['gambar'];?>" alt="<?php echo $row['gambar'];?>" class="rounded" width="100"></div>
                        </td>
                        <td>
                          <?php echo $row['deskripsi'];?>
                        </td>
                        <td>
                          <?php echo $row['harga'];?>
                        </td>
                        <td>
                          <?php echo $row['stok'];?>
                        </td>
                        <td>
                          <?php echo $row['laba'];?>
                        </td>
                        <?php
                        if(helper(3, $account->id_level)){
                         ?>
                        <td>
                          <a href="index.php?page=editproduk&id=<?php echo $row['produk_id']?>">
                            <i class="fas fa-edit"></i>
                          </a> &nbsp;&nbsp;
                          <a href="#" onclick="hapusproduk('index.php?page=daftarproduk&delete=<?php echo $row['produk_id']; ?>')">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
                        <?php
                        }
                        ?>
                      </tr>

                  </tbody>
                </table>
              </div>
              <div class="col-md-12">
                <nav aria-label="Page navigation">
                  <ul class="pagination">
                  </ul>
                </nav>
                <div class="custom-file mb-3">
                  <a href="index.php?page=daftarproduk" input type="submit" class="centerHorizontal btn btn-primary">Kembali</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</tbody>
</table>
</div>
<div class="col-md-12">
<nav aria-label="Page navigation">
<ul class="pagination">

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
$del=mysqli_query($h,"DELETE FROM produk WHERE produk_id = '$id'");
if ($del) {
?>
<script type="text/javascript">
// alert("berhasil menghapus produksi_jadwal");
window.location.href="index.php?page=daftarproduk";
</script>
<?php
}else {
?>
<script language="javascript">
alert ("produk gagal Di Hapus"); document.location="index.php?page=daftarproduk";
</script>
<?php
}
}
?>
<script>
function hapusproduk(url){
var x = confirm("Apakah Anda ingin menghapus data ini?");
if(x){
window.location.href = url;
}
}
</script>
