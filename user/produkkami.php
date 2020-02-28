<?php
$jumlah = mysqli_num_rows(mysqli_query($h, "SELECT * from produk"));
$banyak_data = floor($jumlah/5)+1;
$limit = 0;
$query_slideshow = mysqli_query($h, "SELECT * from produk ORDER BY RAND() ASC LIMIT 3 ");
$count_slideshow = mysqli_num_rows(mysqli_query($h, "SELECT * from produk ORDER BY RAND() ASC LIMIT 3 "));

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

    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>

<div class="row">
    <div class="col-xs-12">
        <div class="section__title--2">
            <!-- <span style="font-size:25px">Daftar produk kami</span> -->
    </div>
</div>



<div class="htc__product__container">
    <div class="row">
        <div class="product__list clearfix mt--30" style="position: relative; height: 0px;">
          <div class="col-md-12" style="margin:20px;padding:background-color:white">
            <?php
            if($count_slideshow < 0){

              ?>
              <div id="myCarousel" class="carousel slide" data-ride="carousel" style="">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <?php
                  for($i=0;$i<$count_slideshow;$i++){
                    ?>
                    <li data-target="#myCarousel" data-slide-to="<?= $i ?>" <?php if($i == 0) echo 'class="active"'; ?>></li>
                    <?php
                  }
                  ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                  <?php
                  $numb = 0;
                  while($row = $query_slideshow->fetch_array()){
                    ?>
                    <div class="item <?php if($numb == 0)echo "active"; ?>">
                      <img src="admin/data/photos/<?= $row['gambar']; ?>" alt="Los Angeles">
                    </div>
                    <?php
                    $numb++;
                  }
                  ?>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>

              <?php
            }
            ?>
          </div>

            <!-- Start Single Category -->
            <?php
            while($row = $query_produk->fetch_array()){
              $no++;
              $hargaproduk = 0;
              $produk_id = $row['produk_id'];
              $databahan2 = mysqli_query($h, "SELECT * from produk
                  JOIN bahan_produksi ON produk.produk_id = bahan_produksi.id_produk
                  JOIN bahan ON bahan.bahan_id = bahan_produksi.id_bahan
                  WHERE produk.produk_id = $produk_id");
              while($rows = $databahan2->fetch_array()){
                  $hargaproduk = $hargaproduk+($rows['jumlah']*$rows['harga']);
              }
              $hargaproduk = $hargaproduk+$row["biayaproduk"];
              ?>
              <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                <div class="col-md-12 item-product">
                  <div class="category">
                    <div class="ht__cat__thumb">
                      <a href="index.php?page=produk-details&id=<?php echo $row['produk_id']?>">
                        <img class="heightRect center-cropped" src="admin/data/photos/<?php echo $row['gambar'];?>" alt="product images"></div>
                      </a>
                    </div>
                    <div class="fr__hover__info">
                      <ul class="product__action">
                        <li><a href="cart.html"><i class="icon-handbag icons"></i></a></li>
                      </ul>
                    </div>
                    <div class="fr__product__inner card-body">
                      <div class="old__prize">
                        <a href="index.php?page=produk-details&id=<?php echo $row['produk_id']?>"><?php echo $row['nama_produk'];?></a>
                      </div>
                      <ul class="fr__pro__prize">
                        <li class="old__prize">
                          Rp. <?= number_format(($hargaproduk+$row['laba']),2,',','.') ?>
                        </li>
                        <li></li>
                      </ul>
                      <ul>
                        <li style="margin-top:10px;text-align:right;margin-bottom:20px">
                          <?php
                            if($isUserLogin){
                              $sourcedata = $row;
                              $sourcedata['deskripsi'] = "";
                              $sourcedata[2] = "";
                            ?>
                            <button type="button" class="btn btn-info" onclick="onButtonPesan('<?= str_replace('"', "+", json_encode($sourcedata)); ?>')">Pesan</button>
                            <?php
                            }
                           ?>
                        </li>
                      </ul>
                    </div>
                </div>
                </div>
              <?php } ?>
            </div>
        </div>
    </div>

</div>
</div>
