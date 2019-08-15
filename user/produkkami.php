<?php
$jumlah = mysqli_num_rows(mysqli_query($h, "SELECT * from produk"));
$banyak_data = floor($jumlah/5)+1;
$limit = 0;
if(isset($_GET["r"])){
  $active_list = $_GET["r"];
  $first = ($_GET["r"]*5);
  $limit = $first-5;
  $query_produk = mysqli_query($h, "SELECT * from produk
                                    ORDER BY produk.nama_produk ASC LIMIT 5 OFFSET ".$limit);
}else{
  if($banyak_data>1){
      $query_produk = mysqli_query($h, "SELECT * from produk
                                        ORDER BY produk.nama_produk ASC LIMIT 5");
    }else{
      $query_produk = mysqli_query($h, "SELECT * from produk
                                        ORDER BY produk.nama_produk ASC");
    }
}
if($query_produk){
	$no = $limit;
}
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
            <h2 class="title__line">Daftar produk kami</h2>


    </div>
</div>



<div class="htc__product__container">
    <div class="row">
        <div class="product__list clearfix mt--30" style="position: relative; height: 0px;">
            <!-- Start Single Category -->
            <?php
            while($row = $query_produk->fetch_array()){
              $no++;
              ?>
              <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                <div class="category">
                  <div class="ht__cat__thumb">
                    <a href="index.php?page=produk-details&id=<?php echo $row['produk_id']?>">
                      <img src="admin/data/photos/<?php echo $row['gambar'];?>" alt="product images"></div>
                    </a>
                  </div>
                  <div class="fr__hover__info">
                    <ul class="product__action">
                      <li><a href="cart.html"><i class="icon-handbag icons"></i></a></li>
                    </ul>
                  </div>
                  <div class="fr__product__inner">
                    <h4><a href="index.php?page=produk-details"><?php echo $row['nama_produk'];?></a></h4>
                    <ul class="fr__pro__prize">
                      <li class="old__prize"><?php echo $row['harga'];?></li>
                    </ul>
                  </div>
                </div>
              <?php } ?>
            </div>

            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
              <div class="category">
                <div class="ht__cat__thumb">
                  <a href="product-details.html">
                    <img src="images/product/8.jpg" alt="product images">
                  </a>
                </div>
                <div class="fr__hover__info">
                  <ul class="product__action">


                    <li><a href="cart.html"><i class="icon-handbag icons"></i></a></li>


                  </ul>
                </div>
                <div class="fr__product__inner">
                  <h4><a href="product-details.html">Product Title Here </a></h4>
                  <ul class="fr__pro__prize">
                    <li class="old__prize">$30.3</li>
                    <li>$25.9</li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- End Single Category -->

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
