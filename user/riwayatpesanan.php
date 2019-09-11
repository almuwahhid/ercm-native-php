<?php
  $query = "SELECT * from orderan where customers_id = '$user->customers_id' AND done = 1 ORDER BY tanggal DESC";
  $jumlah = mysqli_num_rows(mysqli_query($h, $query));

  $isShow = false;
  if($jumlah > 0){
    $isShow = true;
    $data = mysqli_query($h, $query);
  }

?>

<div class="container">
    <div class="row">
      <div class="col-md-12" style="margin-left:5px">
        <a href="index.php">Home</a> > Riwayat Pesanan Saya
      </div>
        <div class="col-md-8" style="margin-top:20px">
            <?php
              if($isShow){
              ?>
              <div class="checkout__inner">
                  <div class="accordion-list">
                      <div class="accordion">
                        <?php
                        $numb = 0;
                        while($row = $data->fetch_array()){
                          ?>
                          <div class="accordion__title">
                              <?= tanggal($row['tanggal']) ?>
                          </div>
                          <div class="accordion__body">
                              <div class="accordion__body__form">
                                  <div class="row">
                                    <?php
                                    $no_order = $row['no_order'];
                                    $query1 = "SELECT * from order_detail JOIN produk ON produk.produk_id = order_detail.produk_id where no_order = '$no_order'";
                                    $data1 = mysqli_query($h, $query1);
                                    while($row1 = $data1->fetch_array()){
                                    ?>
                                      <div class="col-md-12">
                                        <div class="col-md-3">
                                          <a href="index.php?page=produk-details&id=<?php echo $row1['produk_id']?>">
                                            <img src="admin/data/photos/<?= $row1['gambar'] ?>" alt="product images">
                                          </a>
                                        </div>
                                        <div class="col-md-9 centerVertical">
                                          <h2><a href="index.php?page=produk-details&id=<?php echo $row1['produk_id']?>"><?= $row1['nama_produk'] ?></a></h2>
                                          <span class="quantity">Jumlah : <?= $row1['jumlah'] ?> x Rp. <?= number_format($row1['harga'],2,',','.')?> </span><br>
                                          <span class="shp__price">Total : Rp. <?= number_format($row1['subtotal'],2,',','.') ?></span>
                                        </div>
                                      </div>
                                      <?php
                                    }
                                      ?>
                                  </div>
                              </div>
                          </div>
                            <?php
                            $numb++;
                          }
                          ?>
                      </div>
                  </div>
              </div>
                <?php
              } else {
                ?>
                <div class="checkout__inner" style="margin-top:60px">
                  <div class="accordion__title text-center">
                      Belum ada item yang sudah dipesan
                  </div>
                </div>
                <?php
              }
             ?>

        </div>
        <div class="col-md-4">
            <div class="order-details">
                <h5 class="order-details__title">Profil Anda</h5>
                <div class="order-details__item">
                    <div class="single-item">
                        <div class="single-item__content">
                            <a href="#">Nama</a>
                            <span class="price"><?= $user->nama ?></span>
                        </div>
                    </div>
                    <div class="single-item">
                      <div class="single-item__content">
                          <a href="#">Alamat</a>
                          <span class="price"><?= $user->alamat ?></span>
                      </div>
                    </div>
                    <div class="single-item">
                      <div class="single-item__content">
                          <a href="#">Nomor Telepon</a>
                          <span class="price"><?= $user->telp ?></span>
                      </div>
                    </div>
                    <div class="single-item">
                      <div class="single-item__content text-right">
                          <button onclick="onProfileEdit()" class="btn btn-default" href="#">Edit</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
