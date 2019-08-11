<?php
$jumlah = mysqli_num_rows(mysqli_query($h, "SELECT * from supplier"));
$banyak_data = floor($jumlah/5)+1;
$limit = 0;
if(isset($_GET["r"])){
  $active_list = $_GET["r"];
  $first = ($_GET["r"]*5);
  $limit = $first-5;
  $query_supplier = mysqli_query($h, "SELECT * from supplier
                                    ORDER BY supplier.nama ASC LIMIT 5 OFFSET ".$limit);
}else{
  if($banyak_data>1){
      $query_supplier = mysqli_query($h, "SELECT * from supplier
                                        ORDER BY supplier.nama ASC LIMIT 5");
    }else{
      $query_supplier = mysqli_query($h, "SELECT * from supplier
                                        ORDER BY supplier.nama ASC");
    }
}
if($query_supplier){
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
          <h2 class="pageheader-title">Daftar Supplier</h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Supplier</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Supplier</li>
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
            <h5 class="card-header">Supplier yang sudah ditambahkan</h5>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">
                      <th class="border-0 centerHorizontal" style="width:20px">No</th>
                      <th class="border-0">Nama Supplier</th>
                      <th class="border-0">Email</th>
                      <th class="border-0">Username</th>
                      <th class="border-0">Password</th>
                      <th class="border-0">Alamat</th>
                      <th class="border-0">Telp</th>
                      <?php
                      if(helper(2, $account->id_level)){
                       ?>
                      <th class="border-0">Akses</th>
                      <?php
                      }
                     ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($row = $query_supplier->fetch_array()){
                      $no++;
                      ?>

                      <tr>
                        <td class="centerHorizontal">
                          <?php echo $no;?>
                        </td>
                        <td>
                          <?php echo $row['nama'];?>
                        </td>
                        <td>
                          <?php echo $row['email'];?>
                        </td>
                        <td>
                          <?php echo $row['username'];?>
                        </td>
                        <td>
                          <?php echo $row['password'];?>
                        </td>
                        <td>
                          <?php echo $row['alamat'];?>
                        </td>
                        <td>
                          <?php echo $row['telp'];?>
                        </td>
                        <?php
                        if(helper(2, $account->id_level)){
                         ?>
                        <td>
                          <a href="index.php?page=editsupplier&id=<?php echo $row['supplier_id']?>">
                            <i class="fas fa-edit"></i>
                          </a> &nbsp;&nbsp;
                          <a href="#" onclick="hapussupplier('index.php?page=daftarsupplier&delete=<?php echo $row['supplier_id']; ?>')">
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
  $del=mysqli_query($h,"DELETE FROM supplier WHERE supplier_id = '$id'");
  if ($del) {
    ?>
    <script type="text/javascript">
    // alert("berhasil menghapus supplier");
    window.location.href="index.php?page=daftarsupplier";
    </script>
    <?php
  }else {
    ?>
    <script language="javascript">
    alert ("supplier gagal Di Hapus"); document.location="index.php?page=daftarsupplier";
    </script>
    <?php
  }
}
?>
<script>
function hapussupplier(url){
  var x = confirm("Apakah Anda ingin menghapus data ini?");
  if(x){
    window.location.href = url;
  }
}
</script>
