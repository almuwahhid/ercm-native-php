<?php
$jumlah = mysqli_num_rows(mysqli_query($h, "SELECT * from orderan"));
$banyak_data = floor($jumlah/5);
$limit = 0;
if(isset($_GET["r"])){
  $active_list = $_GET["r"];
  $first = ($_GET["r"]*5);
  $limit = $first-5;
  $query_orderan = mysqli_query($h, "SELECT * from orderan
                                    JOIN customers ON orderan.customers_id = customers.customers_id
                                    ORDER BY orderan.tanggal ASC LIMIT 5 OFFSET ".$limit);
}else{
  if($banyak_data>1){
      $query_orderan = mysqli_query($h, "SELECT * from orderan
                                        JOIN customers ON orderan.customers_id = customers.customers_id
                                        ORDER BY orderan.tanggal ASC LIMIT 5");
    }else{
      $query_orderan = mysqli_query($h, "SELECT * from orderan
                                        JOIN customers ON orderan.customers_id = customers.customers_id
                                        ORDER BY orderan.tanggal ASC");
    }
}
if($query_orderan){
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
          <h2 class="pageheader-title">Daftar Order</h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?page=daftarorder" class="breadcrumb-link">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Order</li>
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
            <h5 class="card-header">Order yang sudah ditambahkan</h5>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">
                      <th class="border-0 text-center" style="width:20px">No</th>
                      <th class="border-0 text-center">Nama Customers</th>
                      <th class="border-0 text-center">Tanggal Order</th>
                      <th class="border-0 text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($row = $query_orderan->fetch_array()){
                      $no++;
                      ?>

                      <tr>
                        <td class="text-center">
                          <?php echo $no;?>
                        </td>
                        <td class="text-center">
                          <?php echo $row['nama'];?>
                        </td>
                        <td class="text-center">
                          <?php echo parseTanggal($row['tanggal']);?>
                        </td>
                        <td class="text-center">
                          <a href="index.php?page=detailorder&id=<?php echo $row['no_order']?>">
                            <i class="fas fa-search"></i>
                          </a>
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
                            echo "<li class='page-item'><a class='page-link' href='?page=daftarorder&r=".$i."'>".$i."</a></li>";
                          }
                        }else{
                          if($i==1){
                            echo '<li class="active page-item"><a class="page-link">'.$i.'</a></li>';
                          }else{
                            echo "<li class='page-item'><a class='page-link' href='?page=daftarorder&r=".$i."'>".$i."</a></li>";
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
