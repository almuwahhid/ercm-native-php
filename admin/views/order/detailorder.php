  <?php
  $jumlah = mysqli_num_rows(mysqli_query($h, "SELECT * from order_detail"));
  $banyak_data = floor($jumlah/5)+1;
  $limit = 0;
  if(isset($_GET["r"])){
    $active_list = $_GET["r"];
    $first = ($_GET["r"]*5);
    $limit = $first-5;
    $query_order_detail = mysqli_query($h, "SELECT * from order_detail
                                      JOIN orderan ON order_detail.no_order = orderan.no_order
                                      JOIN produk ON order_detail.produk_id = produk.produk_id
                                      ORDER BY order_detail.hrg_jual ASC LIMIT 5 OFFSET ".$limit);
  }else{
    if($banyak_data>1){
        $query_order_detail = mysqli_query($h, "SELECT * from order_detail
                                          JOIN orderan ON order_detail.no_order = orderan.no_order
                                          JOIN produk ON order_detail.produk_id = produk.produk_id
                                          ORDER BY order_detail.hrg_jual ASC LIMIT 5");
      }else{
        $query_order_detail = mysqli_query($h, "SELECT * from order_detail
                                          JOIN orderan ON order_detail.no_order = orderan.no_order
                                          JOIN produk ON order_detail.produk_id = produk.produk_id
                                          ORDER BY order_detail.hrg_jual ASC");
      }
  }
  if($query_order_detail){
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
            <h2 class="pageheader-title">Daftar Detail Order</h2>
            <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
            <div class="page-breadcrumb">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php?page=daftarorder" class="breadcrumb-link">Daftar Order</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Daftar Detail Order</li>
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
              <h5 class="card-header">Detail Order yang sudah ditambahkan</h5>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="bg-light">
                      <tr class="border-0">
                        <th class="border-0 centerHorizontal" style="width:20px">No</th>
                        <th class="border-0">Nama Produk</th>
                        <th class="border-0">Tanggal Order</th>
                        <th class="border-0">Deskripsi</th>
                        <th class="border-0">Jumlah</th>
                        <th class="border-0">Harga Jual</th>
                        <th class="border-0">Subtotal</th>
                        <th class="border-0">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while($row = $query_order_detail->fetch_array()){
                        $no++;
                        ?>

                        <tr>
                          <td class="centerHorizontal">
                            <?php echo $no;?>
                          </td>
                          <td>
                            <?php echo $row['nama_produk'];?>
                          </td>
                          <td>
                            <?php echo $row['tanggal'];?>
                          </td>
                          <td>
                            <?php echo $row['deskripsi'];?>
                          </td>
                          <td>
                            <?php echo $row['jumlah'];?>
                          </td>
                          <td>
                            <?php echo $row['hrg_jual'];?>
                          </td>

                          <td>
                            <?php echo $row['subtotal'];?>
                          </td>
                          <td>
                            <?php echo $row['total'];?>
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
    $del=mysqli_query($h,"DELETE FROM order_detail WHERE no_det = '$id'");
    if ($del) {
      ?>
      <script type="text/javascript">
      // alert("berhasil menghapus order_detail");
      window.location.href="index.php?page=daftardetailorder";
      </script>
      <?php
    }else {
      ?>
      <script language="javascript">
      alert ("Detail Order gagal Di Hapus"); document.location="index.php?page=daftarkirimbahan";
      </script>
      <?php
    }
  }
  ?>
  <script>
  function hapusdetailoder(url){
    var x = confirm("Apakah Anda ingin menghapus data ini?");
    if(x){
      window.location.href = url;
    }
  }
  </script>
