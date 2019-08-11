<?php
$jumlah = mysqli_num_rows(mysqli_query($h, "SELECT * from kategori"));
$banyak_data = floor($jumlah/5)+1;
$limit = 0;
if(isset($_GET["r"])){
  $active_list = $_GET["r"];
  $first = ($_GET["r"]*5);
  $limit = $first-5;
  $query_kategori = mysqli_query($h, "SELECT * from kategori
                                    ORDER BY kategori.nama_kategori ASC LIMIT 5 OFFSET ".$limit);
}else{
  if($banyak_data>1){
      $query_kategori = mysqli_query($h, "SELECT * from kategori
                                        ORDER BY kategori.nama_kategori ASC LIMIT 5");
    }else{
      $query_kategori = mysqli_query($h, "SELECT * from kategori
                                        ORDER BY kategori.nama_kategori ASC");
    }
}
if($query_kategori){
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
          <h2 class="pageheader-title">Daftar Kategori</h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Kategori</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Kategori</li>
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
            <h5 class="card-header">Kategori yang sudah ditambahkan</h5>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">
                      <th class="border-0 centerHorizontal" style="width:20px">No</th>
                      <th class="border-0">Nama Kategori</th>
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
                    <?php
                    while($row = $query_kategori->fetch_array()){
                      $no++;
                      ?>

                      <tr>
                        <td class="centerHorizontal">
                          <?php echo $no;?>
                        </td>
                        <td>
                          <?php echo $row['nama_kategori'];?>
                        </td>
                        <?php
                        if(helper(3, $account->id_level)){
                         ?>
                        <td>
                          <a href="index.php?page=editkategori&id=<?php echo $row['kategori_id']?>">
                            <i class="fas fa-edit"></i>
                          </a> &nbsp;&nbsp;
                          <a href="#" onclick="hapuskategori('index.php?page=daftarkategori&delete=<?php echo $row['kategori_id']; ?>')">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
                        <?php
                        }
                        ?>
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
                            echo "<li class='page-item'><a class='page-link' href='?r=".$i."'>".$i."</a></li>";
                          }
                        }else{
                          if($i==1){
                            echo '<li class="active page-item"><a class="page-link">'.$i.'</a></li>';
                          }else{
                            echo "<li class='page-item'><a class='page-link' href='?r=".$i."'>".$i."</a></li>";
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
  $del=mysqli_query($h,"DELETE FROM kategori WHERE kategori_id = '$id'");
  if ($del) {
    ?>
    <script type="text/javascript">
    // alert("berhasil menghapus kategori");
    window.location.href="index.php?page=daftarkategori";
    </script>
    <?php
  }else {
    ?>
    <script language="javascript">
    alert ("kategori gagal Di Hapus"); document.location="index.php?page=daftarkategori";
    </script>
    <?php
  }
}
?>
<script>
function hapuskategori(url){
  var x = confirm("Apakah Anda ingin menghapus data ini?");
  if(x){
    window.location.href = url;
  }
}
</script>
