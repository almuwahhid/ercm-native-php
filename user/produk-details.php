<?php
  $iddata=$_GET['id'];
  $hasil=mysqli_query($h, "SELECT * from produk where produk_id = '$iddata'");
  $row = mysqli_fetch_assoc($hasil);
?>

<html class="js sizes customelements history pointerevents postmessage webgl websockets cssanimations csscolumns csscolumns-width csscolumns-span csscolumns-fill csscolumns-gap csscolumns-rule csscolumns-rulecolor csscolumns-rulestyle csscolumns-rulewidth csscolumns-breakbefore csscolumns-breakafter csscolumns-breakinside flexbox picture srcset webworkers" lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Asbab - eCommerce HTML5 Templatee</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
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


    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
<div class="row">
    <div class="col-xs-12">
        <div class="section__title--2 text-center">
            <h2 class="title__line">Detail Produk</h2>


    </div>
</div>



<div class="htc__product__container">
    <div class="row">
        <div class="product__list clearfix mt--30" style="position: relative; height: 0px;">
            <!-- Start Single Category -->

              <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                <div class="category">
                  <div class="ht__cat__thumb">

                      <img src="admin/data/photos/<?php echo $row['gambar'];?>" alt="product images"></div>

                  </div>
                  <div class="fr__hover__info">
                    <ul class="product__action">
                      <li><a href="cart.html"><i class="icon-handbag icons"></i></a></li>
                    </ul>
                  </div>
                  <div class="fr__product__inner">
                    <ul class="fr__pro__prize">
                      <li class="old__prize"><h4>Nama Produk : <?php echo $row['nama_produk'];?></h4></li>
                    </ul>

                    <ul class="fr__pro__prize">
                      <li class="old__prize"><h4>Deskripsi : <?php echo $row['deskripsi'];?></h4></li>
                    </ul>

                    <ul class="fr__pro__prize">
                      <li class="old__prize"><h4>Harga : <?php echo $row['harga'];?></h4></li>
                    </ul>
                  </div>
                </div>

            </div>
        </div>
    </div>

</div>


</div>
<script src="js/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap framework js -->
<script src="js/bootstrap.min.js"></script>
<!-- All js plugins included in this file. -->
<script src="js/plugins.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<!-- Waypoints.min.js. -->
<script src="js/waypoints.min.js"></script>
<!-- Main js file that contents all jQuery plugins activation. -->
<script src="js/main.js"></script><a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647; display: none;"><i class="zmdi zmdi-chevron-up"></i></a>



</body></html>
