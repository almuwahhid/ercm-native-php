  <?php
  $jumlah = mysqli_num_rows(mysqli_query($h, "SELECT * from order_detail"));
  $banyak_data = floor($jumlah/5);
  $limit = 0;
  $id_detail_order = $_GET['id'];
  $query_order_detail = mysqli_query($h, "SELECT * from order_detail
                                    JOIN orderan ON order_detail.no_order = orderan.no_order
                                    JOIN produk ON order_detail.produk_id = produk.produk_id
                                    WHERE orderan.no_order = '$id_detail_order'
                                    ORDER BY order_detail.hrg_jual ASC");
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
                        <th class="border-0 text-center" style="width:20px">No</th>
                        <th class="border-0 text-center">Nama Produk</th>
                        <th class="border-0 text-center">Tanggal Order</th>
                        <th class="border-0 text-center">Jumlah</th>
                        <th class="border-0 text-center">Harga Jual</th>
                        <th class="border-0 text-center">Subtotal</th>
                        <th class="border-0 text-center">Keuntungan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $total = 0;
                      $jumlah_keuntungan = 0;
                      while($row = $query_order_detail->fetch_array()){
                        $no++;
                        $total += $row['subtotal'];
                        ?>

                        <tr>
                          <td class="text-center">
                            <?php echo $no;?>
                          </td>
                          <td class="text-center">
                            <?php echo $row['nama_produk'];?>
                          </td>
                          <td class="text-center">
                            <?php echo parseTanggal($row['tanggal']);?>
                          </td>
                          <td class="text-center">
                            <?php echo $row['jumlah'];?>
                          </td>
                          <td class="text-center">
                            Rp. <?= number_format($row['hrg_jual'],2,',','.')?>
                          </td>
                          <td class="text-center">
                            Rp. <?= number_format($row['subtotal'],2,',','.')?>
                          </td>
                          <td class="text-center">
                            <?php
                            $keuntungan = ($row['laba'] * $row['jumlah']);?>
                            Rp. <?= number_format($keuntungan,2,',','.')?>
                          </td>
                        </tr>

                        <?php
                        $jumlah_keuntungan += $keuntungan;
                      }
                      ?>
                      <tr>
                        <th colspan="6" class="text-right">
                          Total :
                        </th>
                        <th class="text-center">
                          Rp. <?= number_format($total,2,',','.')?>
                        </th>
                      </tr>
                      <tr>
                        <th colspan="6" class="text-right">
                          Total Keuntungan :
                        </th>
                        <th class="text-center">
                          Rp. <?= number_format($jumlah_keuntungan,2,',','.')?>
                        </th>
                      </tr>
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
