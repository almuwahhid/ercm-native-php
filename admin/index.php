<?php
session_start();
include "../koneksi.php";

// Abott tenann
// coba

function helper($data, $data2){
  if($data == $data2){
    return true;
  } else {
    return false;
  }
}

$koneksi = new Koneksi();
$h = $koneksi->connect();

if (!isset($_SESSION['super_user'])){
  header("Location: login.php");
  // echo "string";
} else {
  $account = json_decode($_SESSION['super_user']);
}

$a;
if(isset($_GET['page'])){

  if ($_GET['page']=="editproduk") {
    $a = 1;
  }else if ($_GET['page']=="tambahproduk") {
    $a = 1;
  }else if ($_GET['page']=="daftarproduk") {
    $a = 1;

  }else if ($_GET['page']=="editproduksi") {
    $a = 2;
  }else if ($_GET['page']=="tambahproduksi") {
    $a = 2;
  }else if ($_GET['page']=="daftarproduksi") {
    $a = 2;

  }else if ($_GET['page']=="editjadwal") {
    $a =3;
  }else if ($_GET['page']=="tambahjadwal") {
    $a = 3;
  }else if ($_GET['page']=="daftarjadwal") {
    $a = 3;

  }else if ($_GET['page']=="editbahan") {
    $a = 4;
  }else if ($_GET['page']=="tambahbahan") {
    $a = 4;
  }else if ($_GET['page']=="daftarbahan") {
    $a = 4;

  }else if ($_GET['page']=="editkirimbahan") {
    $a = 5;
  }else if ($_GET['page']=="tambahkirimbahan") {
    $a = 5;
  }else if ($_GET['page']=="daftarkirimbahan") {
    $a = 5;

  }else if ($_GET['page']=="editorder") {
    $a = 6;
  }else if ($_GET['page']=="detailhorder") {
    $a = 6;
  }else if ($_GET['page']=="daftarorder") {
    $a = 6;

  }else if ($_GET['page']=="daftaruser") {
    $a = 7;
  }else if ($_GET['page']=="daftarcustomers") {
    $a = 7;
  }else if ($_GET['page']=="daftarsupplier") {
    $a = 7;
  }else if ($_GET['page']=="tambahcustomers") {
    $a = 7;
  }else if ($_GET['page']=="tambahsupplier") {
    $a = 7;

  }else if ($_GET['page']=="daftarkategori") {
    $a = 9;
  }else if ($_GET['page']=="tambahkategori") {
    $a = 9;
  }else if ($_GET['page']=="editkategori") {
    $a = 9;


  }else if ($_GET['page']=="setting") {
    $a = 12;
  }
}else{
  $a = 0;
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
  <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/concept/style.css">
  <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
  <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
  <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
  <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
  <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">

  <link rel="stylesheet" href="assets/css/style-skripsi.css">
  <title>Admin Penjualan</title>
</head>

<body>
  <!-- ============================================================== -->
  <!-- main wrapper -->
  <!-- ============================================================== -->
  <div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <div class="dashboard-header">
      <nav class="navbar navbar-expand-lg bg-white fixed-top">
        <a class="navbar-brand" href="index.php"><?= $account->nama_level?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>
    </div>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <div class="nav-left-sidebar sidebar-dark">
      <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav flex-column">
              <li class="nav-divider">
                Menu

                <?php
                if(helper(3, $account->id_level) || helper(1, $account->id_level)){
                  ?>
                  <li class="nav-item ">
                    <a class="nav-link <?php if($a == 1) echo 'active'; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-paw"></i>Produk<span class="badge badge-success">1</span></a>
                    <div id="submenu-1" class="collapse submenu" style="">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link" href="index.php?page=daftarproduk">Daftar Produk</a>
                        </li>
                        <?php
                        if(helper(3, $account->id_level)){
                          ?>
                          <li class="nav-item">
                            <a class="nav-link" href="index.php?page=tambahproduk">Tambah Produk</a>
                          </li>
                          <?php
                        }
                        ?>
                      </ul>
                    </div>
                  </li>
                  <?php
                }
                ?>

                <?php
                if(helper(3, $account->id_level)){
                  ?>
                  <li class="nav-item ">
                    <a class="nav-link <?php if($a == 2) echo 'active'; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-cubes"></i>Produksi<span class="badge badge-success">2</span></a>
                    <div id="submenu-2" class="collapse submenu" style="">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link" href="index.php?page=daftarproduksi">Daftar Produksi</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="index.php?page=tambahproduksi">Tambah Produksi</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <?php
                }
                ?>

                <?php
                if(helper(3, $account->id_level)){
                  ?>
                  <li class="nav-item ">
                    <a class="nav-link <?php if($a == 3) echo 'active'; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fa fa-fw fa-cubes"></i>Jadwal Produksi<span class="badge badge-success">3</span></a>
                    <div id="submenu-3" class="collapse submenu" style="">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link" href="index.php?page=daftarjadwal">Daftar Jadwal Produksi</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="index.php?page=tambahjadwal">Tambah Jadwal Produksi</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <?php
                }
                ?>
              </li>

              <?php
              if(helper(3, $account->id_level) || helper(1, $account->id_level)){
                ?>
                <li class="nav-item ">
                  <a class="nav-link <?php if($a == 4) echo 'active'; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fa fa-fw fa-cube"></i>Bahan<span class="badge badge-success">4</span></a>
                  <div id="submenu-4" class="collapse submenu" style="">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?page=daftarbahan">Daftar Bahan</a>
                      </li>
                      <?php
                      if(helper(3, $account->id_level)){
                        ?>
                        <li class="nav-item">
                          <a class="nav-link" href="index.php?page=tambahbahan">Tambah Bahan</a>
                        </li>
                        <?php
                      }
                      ?>
                    </ul>
                  </div>
                </li>
                <?php
              }
              ?>

              <?php
              if(helper(4, $account->id_level)){
                ?>
                <li class="nav-item ">
                  <a class="nav-link <?php if($a == 5) echo 'active'; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fa fa-fw fa-cube"></i>Pengiriman Bahan<span class="badge badge-success">5</span></a>
                  <div id="submenu-5" class="collapse submenu" style="">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?page=daftarkirimbahan">List Pengiriman Bahan</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?page=tambahkirimbahan">Tambah Pengiriman Bahan</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <?php
              }
              ?>

              <?php
              if(helper(3, $account->id_level)){
                ?>
                <li class="nav-item ">
                  <a class="nav-link <?php if($a == 6) echo 'active'; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fa fa-fw fa-cube"></i>Order Produk<span class="badge badge-success">6</span></a>
                  <div id="submenu-6" class="collapse submenu" style="">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?page=daftarorder">Daftar Order Produk</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <?php
              }
              ?>

              <?php
              if(helper(1, $account->id_level) || helper(3, $account->id_level)){
                ?>
                <li class="nav-item ">
                  <a class="nav-link <?php if($a == 9) echo 'active'; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9"><i class="fa fa-fw fa-cube"></i>Kategori<span class="badge badge-success">9</span></a>
                  <div id="submenu-9" class="collapse submenu" style="">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <?php
                        if(helper(1, $account->id_level) || helper(3, $account->id_level)){
                          ?>
                          <a class="nav-link" href="index.php?page=daftarkategori">Daftar Kategori</a>
                          <?php
                        }
                        ?>
                        <?php
                        if(helper(3, $account->id_level)){
                          ?>
                          <a class="nav-link" href="index.php?page=tambahkategori">Tambah Kategori</a>
                          <?php
                        }
                        ?>
                      </li>
                    </ul>
                  </div>
                </li>
                <?php
              }
              ?>

              <?php
              if(helper(2, $account->id_level) || helper(1, $account->id_level)){
                ?>
                <li class="nav-item ">
                  <a class="nav-link <?php if($a == 7) echo 'active'; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-7" aria-controls="submenu-7"><i class="fa fa-fw fa-user"></i>Users<span class="badge badge-success">7</span></a>
                  <div id="submenu-7" class="collapse submenu" style="">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?page=daftarcustomers">Daftar Customers</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?page=daftarsupplier">Daftar Supplier</a>
                      </li>
                      <?php
                      if(helper(2, $account->id_level)){
                        ?>
                        <li class="nav-item">
                          <a class="nav-link" href="index.php?page=tambahcustomers">Tambah Customers</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="index.php?page=tambahsupplier">Tambah Supplier</a>
                        </li>
                        <?php
                      }
                      ?>
                    </ul>
                  </div>
                </li>
                <?php
              }
              ?>

              <li class="nav-item ">
                <a class="nav-link <?php if($a == 8) echo 'active'; ?>" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fa fa-fw fa-cube"></i>Laporan<span class="badge badge-success">8</span></a>
                <div id="submenu-8" class="collapse submenu" style="">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <?php
                      if(helper(2, $account->id_level) || helper(3, $account->id_level)){
                        ?>
                        <a class="nav-link" href="index.php?page=daftarorder">Laporan Produksi</a>
                        <?php
                      }
                      ?>

                      <a class="nav-link" href="index.php?page=daftarorder">Laporan Pembelian Bahan</a>

                      <?php
                      if(helper(2, $account->id_level) || helper(1, $account->id_level) || helper(3, $account->id_level)){
                        ?>
                        <a class="nav-link" href="index.php?page=daftarorder">Laporan Order Produk</a>
                        <?php
                      }
                      ?>
                    </li>
                  </ul>
                </div>
              </li>


              <li class="nav-item">
                <a class="nav-link" href="index.php?page=logout"><i class="fa fa-fw fa-toggle-on"></i>Logout</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
      <div style="min-height:88vh">
        <?php
        if(isset($_GET['page'])){

          if ($_GET['page']=="daftarproduk") {
            include 'views/produk/daftarproduk.php';
          }else if ($_GET['page']=="tambahproduk") {
            include 'views/produk/tambahproduk.php';
          }else if ($_GET['page']=="detailproduk") {
            include 'views/produk/detailproduk.php';
          }else if ($_GET['page']=="editproduk") {
            include 'views/produk/editproduk.php';

          }else if ($_GET['page']=="daftarproduksi") {
            include 'views/produksi/daftarproduksi.php';
          }else if ($_GET['page']=="tambahproduksi") {
            include 'views/produksi/tambahproduksi.php';
          }else if ($_GET['page']=="editproduksi") {
            include 'views/produksi/editproduksi.php';


          }else if ($_GET['page']=="daftarjadwal") {
            include 'views/jadwalproduksi/daftarjadwal.php';
          }else if ($_GET['page']=="tambahjadwal") {
            include 'views/jadwalproduksi/tambahjadwal.php';
          }else if ($_GET['page']=="editjadwal") {
            include 'views/jadwalproduksi/editjadwal.php';

          }else if ($_GET['page']=="daftarbahan") {
            include 'views/bahan/daftarbahan.php';
          }else if ($_GET['page']=="editbahan") {
            include 'views/bahan/editbahan.php';
          }else if ($_GET['page']=="tambahbahan") {
            include 'views/bahan/tambahbahan.php';

          }else if ($_GET['page']=="daftarkirimbahan") {
            include 'views/kirimbahan/daftarkirimbahan.php';
          }else if ($_GET['page']=="tambahkirimbahan") {
            include 'views/kirimbahan/tambahkirimbahan.php';
          }else if ($_GET['page']=="editkirimbahan") {
            include 'views/kirimbahan/editkirimbahan.php';

          }else if ($_GET['page']=="daftarorder") {
            include 'views/order/daftarorder.php';
          }else if ($_GET['page']=="tambahorder") {
            include 'views/order/tambahorder.php';
          }else if ($_GET['page']=="editorder") {
            include 'views/order/editorder.php';
          }else if ($_GET['page']=="detailorder") {
            include 'views/order/detailorder.php';
          }else if ($_GET['page']=="tambahdetailorder") {
            include 'views/order/tambahdetailorder.php';

          }else if ($_GET['page']=="daftaruser") {
            include 'views/user/daftaruser.php';
          }else if ($_GET['page']=="edituser") {
            include 'views/user/edituser.php';
          }else if ($_GET['page']=="daftarcustomers") {
            include 'views/user/daftarcustomers.php';
          }else if ($_GET['page']=="daftarsupplier") {
            include 'views/user/daftarsupplier.php';
          }else if ($_GET['page']=="tambahcustomers") {
            include 'views/user/tambahcustomers.php';
          }else if ($_GET['page']=="tambahsupplier") {
            include 'views/user/tambahsupplier.php';
          }else if ($_GET['page']=="editcustomers") {
            include 'views/user/editcustomers.php';
          }else if ($_GET['page']=="editsupplier") {
            include 'views/user/editsupplier.php';

          }else if ($_GET['page']=="daftarkategori") {
            include 'views/kategori/daftarkategori.php';
          }else if ($_GET['page']=="tambahkategori") {
            include 'views/kategori/tambahkategori.php';
          }else if ($_GET['page']=="editkategori") {
            include 'views/kategori/editkategori.php';

          }else if ($_GET['page']=="setting") {
            include 'views/setting.php';
          }else if ($_GET['page']=="logout") {
            session_destroy();
            echo "<meta http-equiv='refresh' content='0; url=login.php'>";
          }
        }else{
          include 'welcome.php';
        }
        ?>
      </div>
      <!-- ============================================================== -->
      <!-- footer -->
      <!-- ============================================================== -->
      <div class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
              Copyright © 2018 Admin.
            </div>
          </div>
        </div>
      </div>
      <!-- ============================================================== -->
      <!-- end footer -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- end main wrapper  -->
  <!-- ============================================================== -->
  <!-- Optional JavaScript -->
  <!-- jquery 3.3.1 -->
  <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
  <!-- bootstap bundle js -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <!-- slimscroll js -->
  <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
  <!-- main js -->
  <script src="assets/js/concept/main-js.js"></script>
  <!-- chart chartist js -->
  <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
  <!-- sparkline js -->
  <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
  <!-- morris js -->
  <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
  <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
  <!-- chart c3 js -->
  <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
  <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
  <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
  <script src="assets/js/concept/dashboard-ecommerce.js"></script>
  <script src="assets/js/style.js"></script>
  <script src="https://cdn.ckeditor.com/4.8.0/standard-all/ckeditor.js"></script>
  <script>
    function deleteFoto(url){
      var x = confirm("Apakah Anda ingin menghapus foto ini?");
      if(x){
        window.location.href = url;
      }
    }
  </script>
</body>

</html>


<script>
  CKEDITOR.replace( 'editor1', {
    // Define the toolbar: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_toolbar
    // The standard preset from CDN which we used as a base provides more features than we need.
    // Also by default it comes with a 2-line toolbar. Here we put all buttons in a single row.
    toolbar: [
    { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
    { name: 'styles', items: [ 'Styles', 'Format' ] },
    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
    { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
    { name: 'links', items: [ 'Link', 'Unlink' ] },
    { name: 'insert', items: [ 'Image', 'EmbedSemantic', 'Table' ] },
    { name: 'tools', items: [ 'Maximize' ] },
    { name: 'editing', items: [ 'Scayt' ] }
    ],
    customConfig: '',
    removePlugins: 'image',
    height: 300,
    contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/standard-all/contents.css', 'mystyles.css' ],
    bodyClass: 'article-editor',
    format_tags: 'p;h1;h2;h3;pre',
    removeDialogTabs: 'image:advanced;link:advanced',
    stylesSet: [
    /* Inline Styles */
    { name: 'Marker',			element: 'span', attributes: { 'class': 'marker' } },
    { name: 'Cited Work',		element: 'cite' },
    { name: 'Inline Quotation',	element: 'q' },
    /* Object Styles */
    {
      name: 'Special Container',
      element: 'div',
      styles: {
        padding: '5px 10px',
        background: '#eee',
        border: '1px solid #ccc'
      }
    },
    {
      name: 'Compact table',
      element: 'table',
      attributes: {
        cellpadding: '5',
        cellspacing: '0',
        border: '1',
        bordercolor: '#ccc'
      },
      styles: {
        'border-collapse': 'collapse'
      }
    },
    { name: 'Borderless Table',		element: 'table',	styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
    { name: 'Square Bulleted List',	element: 'ul',		styles: { 'list-style-type': 'square' } },
    /* Widget Styles */
    // We use this one to style the brownie picture.
    { name: 'Illustration', type: 'widget', widget: 'image', attributes: { 'class': 'image-illustration' } },
    // Media embed
    { name: '240p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-240p' } },
    { name: '360p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-360p' } },
    { name: '480p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-480p' } },
    { name: '720p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-720p' } },
    { name: '1080p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-1080p' } }
    ]
  } );
</script>
