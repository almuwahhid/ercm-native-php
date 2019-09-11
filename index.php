<?php
  session_start();
  $isUserLogin = false;
  if (isset($_SESSION['ercm_user'])){
    // header("Location: login_user.php");
    $isUserLogin = true;
    $user = json_decode($_SESSION['ercm_user']);
  }
  include "koneksi.php";

  $koneksi = new Koneksi();
  $h = $koneksi->connect();

  if($isUserLogin){
    $user = json_decode($_SESSION['ercm_user']);
    $query = "SELECT * from orderan where customers_id = '$user->customers_id' AND done = 0";
    $hasil = mysqli_num_rows(mysqli_query($h, $query));
    if($hasil>0){
      $orderan = mysqli_fetch_assoc(mysqli_query($h, $query));
      $query_detailorder = "SELECT * from order_detail JOIN produk ON produk.produk_id = order_detail.produk_id where no_order = '".$orderan['no_order']."'";
    }
  }

?>
<html class="js sizes customelements history pointerevents postmessage webgl websockets cssanimations csscolumns csscolumns-width csscolumns-span csscolumns-fill csscolumns-gap csscolumns-rule csscolumns-rulecolor csscolumns-rulestyle csscolumns-rulewidth csscolumns-breakbefore csscolumns-breakafter csscolumns-breakinside flexbox picture srcset webworkers" lang="en"><head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>ERCM App</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Place favicon.ico in the root directory -->
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">


  <!-- All css files are included here. -->
  <!-- Bootstrap fremwork main css -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="admin/assets/vendor/fonts/fontawesome/css/fontawesome-all.css"> -->
  <!-- Owl Carousel min css -->
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <!-- This core.css file contents all plugings css file. -->
  <link rel="stylesheet" href="css/core.css">
  <!-- Theme shortcodes/elements style -->
  <link rel="stylesheet" href="css/shortcode/shortcodes.css">
  <!-- Theme main style -->
  <link rel="stylesheet" href="css/style.css">
  <!-- Responsive css -->
  <link rel="stylesheet" href="css/responsive.css">
  <!-- User style -->
  <link rel="stylesheet" href="css/custom.css">



  <!-- <link rel="stylesheet" href="assets/css/style-skripsi.css"> -->


  <!-- Modernizr JS -->
  <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>
<body style="background-color:#F1F1F1">
  <!--[if lt IE 8]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <!-- Body main wrapper start -->
  <div class="wrapper">
    <!-- Start Header Style -->
    <header id="htc__header" class="htc__header__area header--one" style="background:#EBEBEB">
      <!-- Start Mainmenu Area -->
      <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
        <div class="container">
          <div class="row">
            <div class="menumenu__container clearfix">
              <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                <div class="logo">
                  <a href="index.php"><img src="images/logo/4.png" alt="logo images"></a>
                </div>
              </div>
              <div class="col-md-7 col-lg-8 col-sm-5 col-xs-3">
                <nav class="main__menu__nav hidden-xs hidden-sm">
                  <ul class="main__menu">
                    <li class="drop"><a href="index.php">Daftar Produk</a></li>
                    <li><a href="index.php?page=kontak">Kontak Kami</a></li>
                    <?php
                      if($isUserLogin){
                     ?>
                      <li><a href="index.php?page=riwayat-pesanan">Riwayat Pesanan Saya</a></li>
                    <?php
                      }
                     ?>
                  </ul>
                </nav>

                <div class="mobile-menu clearfix visible-xs visible-sm">
                  <nav id="mobile_dropdown" style="display: block;">
                    <ul>
                      <li><a href="index.html">Home</a></li>
                      <li><a href="blog.html">blog</a></li>
                      <li><a href="#">pages</a>
                        <ul>
                          <li><a href="blog.html">Blog</a></li>
                          <li><a href="blog-details.html">Blog Details</a></li>
                          <li><a href="cart.html">Cart page</a></li>
                          <li><a href="checkout.html">checkout</a></li>
                          <li><a href="contact.html">contact</a></li>
                          <li><a href="product-grid.html">product grid</a></li>
                          <li><a href="product-details.html">product details</a></li>
                          <li><a href="wishlist.html">wishlist</a></li>
                        </ul>
                      </li>
                      <li><a href="contact.html">contact</a></li>
                    </ul>
                  </nav>
                </div>
              </div>
              <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                <div class="header__right">
                  <div class="header__account" style="margin-top: 60px;margin-right: -20px;">
                    <ul class="main__menu">
                      <li class="drop"><a href="#" style="color: black;font-size: 20px;"><i class="icon-user icons"></i></a>
                        <ul class="dropdown">
                          <?php
                          if($isUserLogin){
                            ?>
                            <li><a onclick="onProfileClick()" href="#">Akun Saya</a></li>
                            <li><a href="index.php?page=logout">Logout</a></li>
                            <?php
                          } else {
                            ?>
                            <li><a href="login.php">Login</a></li>
                            <?php
                          }
                          ?>
                        </ul>
                      </li>
                    </ul>
                  </div>
                  <?php
                  if($isUserLogin){
                    ?>
                    <div class="htc__shopping__cart">



                      <a class="cart__menu" href="#"><i class="icon-handbag icons"></i></a>

                      <?php
                      if($isUserLogin && $hasil > 0){
                        $total_order = mysqli_num_rows(mysqli_query($h, $query_detailorder));
                        ?>
                        <a href="#"><span class="htc__qua">
                          <?= $total_order ?>
                        </span></a>
                        <?php
                      }
                      ?>
                    </div>
                    <?php
                  }
                  ?>

                </div>
              </div>
            </div>
          </div>
          <div class="mobile-menu-area"></div>
        </div>
      </div>
      <!-- End Mainmenu Area -->
    </header>
    <!-- End Header Area -->

    <div class="body__overlay"></div>
    <!-- Start Offset Wrapper -->
    <div class="offset__wrapper">
      <!-- Start Search Popap -->
      <div class="search__area">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="search__inner">
                <form action="#" method="get">
                  <input placeholder="Search here... " type="text">
                  <button type="submit"></button>
                </form>
                <div class="search__close__btn">
                  <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Search Popap -->
      <!-- Start Cart Panel -->
      <div class="shopping__cart">
        <div id="shopping__cart_profile" class="shopping__cart__inner" hidden>
          <div class="offsetmenu__close__btn">
            <a href="#"><i class="zmdi zmdi-close"></i></a>
          </div>
          <ul class="shopping__btn">
            <li class="shp__checkout text-center"><h5>Profil Saya</h5></li>
          </ul>
          <div class="order-details__item" style="margin-top:20px">
              <div class="single-item">
                  <div class="single-item__content">
                      <a href="#">Nama</a><br>
                      <span class="price"><?= $user->nama ?></span><br><br>
                  </div>
              </div>
              <div class="single-item">
                <div class="single-item__content">
                    <a href="#">Alamat</a><br>
                    <span class="price"><?= $user->alamat ?></span><br><br>
                </div>
              </div>
              <div class="single-item">
                <div class="single-item__content">
                    <a href="#">Nomor Telepon</a><br>
                    <span class="price"><?= $user->telp ?></span><br><br>
                </div>
              </div>
              <div class="single-item">
                <div class="single-item__content text-right">
                    <hr>
                    <button onclick="onProfileEdit()" class="btn btn-default" href="#">Edit</button>
                </div>
              </div>
          </div>
        </div>
        <div id="shopping__cart_edit_profile" class="shopping__cart__inner" hidden>
          <div class="offsetmenu__close__btn">
            <a href="#"><i class="zmdi zmdi-close"></i></a>
          </div>
          <ul class="shopping__btn">
            <li class="shp__checkout text-center"><h5>Edit Profil</h5></li>
          </ul>
          <form class="" action="service.php?process=update_profile" method="post" style="margin-top:20px">
            <input type="hidden" name="id" value="<?= $user->customers_id ?>">
            <div class="order-details__item">
                <div class="single-item">
                    <div class="single-item__content">
                        <a href="#">Nama : </a>
                        <span class="quantity"><input value="<?= $user->nama ?>" name="nama" type="text" class="" style="padding:5px;"></input></span>
                    </div>
                </div>
                <div class="single-item">
                  <div class="single-item__content">
                      <a href="#">Alamat : </a>
                      <span class="quantity"><input value="<?= $user->alamat ?>" name="alamat" type="text" class="" style="padding:5px;"></input></span>
                  </div>
                </div>
                <div class="single-item">
                  <div class="single-item__content">
                      <a href="#">Nomor Telepon : </a>
                      <span class="quantity"><input value="<?= $user->telp ?>" name="telp" type="text" class="" style="padding:5px;"></input></span>
                  </div>
                </div>
                <hr>
                <div class="single-item">
                  <div class="single-item__content text-right">
                      <input type="submit" class="btn btn-default" href="#" value="Ubah">
                  </div>
                </div>
            </div>
          </form>
        </div>
        <div id="shopping__cart_pesan" class="shopping__cart__inner" hidden>
          <div class="offsetmenu__close__btn">
            <a href="#"><i class="zmdi zmdi-close"></i></a>
          </div>
          <ul class="shopping__btn">
            <li class="shp__checkout text-center"><h5>Pesanan</h5></li>
          </ul>
          <form class="" action="service.php?process=tambah_keranjang" method="post">
            <div class="shp__single__product">
              <div class="shp__pro__thumb">
                <a href="#">
                  <img src="images/product-2/sm-smg/2.jpg" alt="product images" id="gambar_barang">
                </a>
              </div>
              <div class="shp__pro__details">
                <input type="hidden" id="pesanan_barang" name="pesanan_barang" value="">
                <h2><a id="nama_barang" href="#">Brone Candle</a></h2>
                <span class="quantity">Jumlah : &nbsp;&nbsp; <input name="jumlah_produk" type="text" class="" style="padding:5px;width:70px;margin-top:10px"></input></span>
              </div>
            </div>
            <ul class="shopping__btn">
              <li class="shp__checkout"><input type="submit" value="Tambahkan ke keranjang"></input></li>
            </ul>
          </form>
        </div>
        <div id="shopping__cart_wrapper" class="shopping__cart__inner" hidden>
          <div class="offsetmenu__close__btn">
            <a href="#"><i class="zmdi zmdi-close"></i></a>
          </div>
          <div class="shp__cart__wrap">
            <?php
            if($isUserLogin && $hasil > 0){
              $jumlah = 0;
              $q1 = mysqli_query($h, $query_detailorder);
              while($row = $q1->fetch_array()){
                ?>
                  <div class="shp__single__product">
                    <div class="shp__pro__thumb">
                      <a href="#">
                        <img src="admin/data/photos/<?= $row['gambar'] ?>" alt="product images">
                      </a>
                    </div>
                    <div class="shp__pro__details">
                      <h2><a href="#"><?= $row['nama_produk'] ?></a></h2>
                      <span class="quantity">Jumlah : <?= $row['jumlah'] ?></span>
                      <span class="shp__price">Rp. <?= number_format($row['subtotal'],2,',','.') ?></span>
                    </div>
                    <div class="remove__btn">
                      <a href="service.php?process=deletedetail&id=<?= $row['no_det']?>&id_orderan=<?= $row['no_order']?>" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                    </div>
                  </div>
              <?php
              $jumlah = $jumlah+$row['subtotal'];
              }
             ?>
          </div>
          <ul class="shoping__total">
            <li class="subtotal">Subtotal : </li>
            <li class="total__price">Rp. <?= number_format($jumlah,2,',','.') ?></li>
          </ul>
          <ul class="shopping__btn">
            <!-- <li><a href="#">View Cart</a></li> -->
            <li class="shp__checkout"><a href="service.php?process=konfirmasi&id=<?= $orderan['no_order'] ?>">Pesan Sekarang</a></li>
          </ul>
          <?php
        } else {
          ?>
          <div class="accordion__title text-center">
              Belum ada item yang sudah dipesan
          </div>
          <?php
        }
          ?>
        </div>
      </div>
      <!-- End Cart Panel -->
    </div>
    <!-- End Offset Wrapper -->



    <!-- Start Category Area -->
    <section class="htc__category__area ptb--50">

      <div class="container">
        <?php
        if(isset($_GET['page'])){
          if ($_GET['page']=="produkkami") {
            include 'user/produkkami.php';
          }else if ($_GET['page']=="produk-details") {
            include 'user/produk-details.php';
          }else if ($_GET['page']=="riwayat-pesanan") {
            include 'user/riwayatpesanan.php';
          }else if ($_GET['page']=="logout") {
            session_destroy();
            echo "<meta http-equiv='refresh' content='0; url=index.php'>";
          }
        }else{
          include 'user/produkkami.php';
        }
        ?>

      </div>
    </section>
    <!-- End Banner Area -->
    <!-- Start Footer Area -->
    <footer id="htc__footer">
      <!-- Start Footer Widget -->
      <div class="footer__container bg__cat--1">
        <div class="container">
          <div class="row">
            <!-- Start Single Footer Widget -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="footer">
                <h2 class="title__line--2">TENTANG KAMI</h2>
                <div class="ft__details">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim</p>
                </div>
              </div>
            </div>
            <!-- End Single Footer Widget -->
            <!-- Start Single Footer Widget -->

            <!-- End Single Footer Widget -->
            <!-- Start Single Footer Widget -->

            <div class="col-md-2 col-sm-6 col-xs-12 xmt-40 smt-40">

              <div class="footer">
                <h2 class="title__line--2">AKUN</h2>
                <div class="ft__inner">
                  <ul class="ft__list">
                    <li><a href="#">Akun Saya</a></li>
                    <li><a href="cart.html">Keranjang Saya</a></li>
                    <li><a href="index.php?page=logout">Logout</a></li>


                  </ul>
                </div>
              </div>
            </div>
            <!-- End Single Footer Widget -->
            <!-- Start Single Footer Widget -->

            <!-- End Single Footer Widget -->
            <!-- Start Single Footer Widget -->

            <!-- End Single Footer Widget -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="footer">
                <h2 class="title__line--2">Kontak Kami</h2>
                <div class="ft__details">
                  <p>0858 66558 665</p>

                </div>
              </div>
            </div></div>
          </div>
        </div>
        <!-- End Footer Widget -->
        <!-- Start Copyright Area -->
        <div class="htc__copyright bg__cat--5">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <div class="copyright__inner">
                  <p>@ <a href="https://freethemescloud.com/">ERCM</a> 2019.</p>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Copyright Area -->
      </footer>
      <!-- End Footer Style -->
    </div>

    <!-- Body main wrapper end -->

    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="admin/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="admin/assets/js/style.js"></script>
    <!-- <script src="js/vendor/jquery-3.2.1.min.js"></script> -->
    <!-- Bootstrap framework js -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="js/plugins.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!-- Waypoints.min.js. -->
    <script src="js/waypoints.min.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="js/main.js"></script><a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647; display: none;"><i class="zmdi zmdi-chevron-up"></i></a>


    <script>
    /*------------------------------------
        07 A. Pesan barang area
    --------------------------------------*/
      function onButtonPesan(data){
        var barang = JSON.parse(data.split('+').join('"'));
        // console.log("hii "+data.replace(/+/g, '"'));

        console.log("hii "+data.split('+').join('"'));
        console.log("huu "+barang.nama_produk);

        // e.preventDefault();
        $('.shopping__cart').addClass('shopping__cart__on');
        $('.body__overlay').addClass('is-visible');
        $('#shopping__cart_wrapper').hide();
        $('#shopping__cart_pesan').show();
        $('#shopping__cart_edit_profile').hide();
        $('#shopping__cart_profile').hide();

        $("#pesanan_barang").val(data.split('+').join('"'));
        $("#nama_barang").html(barang.nama_produk);
        $('#gambar_barang').attr('src','admin/data/photos/'+barang.gambar);
        $('#gambar_barang').addClass('centerVertical');

      }
      function onProfileClick(){
        $('.shopping__cart').addClass('shopping__cart__on');
        $('.body__overlay').addClass('is-visible');
        $('#shopping__cart_wrapper').hide();
        $('#shopping__cart_pesan').hide();
        $('#shopping__cart_edit_profile').hide();
        $('#shopping__cart_profile').show();
      }
      function onProfileEdit(){
        $('.shopping__cart').addClass('shopping__cart__on');
        $('.body__overlay').addClass('is-visible');
        $('#shopping__cart_wrapper').hide();
        $('#shopping__cart_pesan').hide();
        $('#shopping__cart_edit_profile').show();
        $('#shopping__cart_profile').hide();
      }
      (function($) {
        $('#myCarousel').carousel({
          interval: 2000
        });
      });

    </script>

  </body>
  </html>

  <?php
function tanggal($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>
