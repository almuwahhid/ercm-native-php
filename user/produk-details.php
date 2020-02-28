<?php
  $iddata=$_GET['id'];
  $hasil=mysqli_query($h, "SELECT * from produk where produk_id = '$iddata'");
  $row = mysqli_fetch_assoc($hasil);

  $hargaproduk = 0;
  $produk_id = $row['produk_id'];
  $databahan2 = mysqli_query($h, "SELECT * from produk
      JOIN bahan_produksi ON produk.produk_id = bahan_produksi.id_produk
      JOIN bahan ON bahan.bahan_id = bahan_produksi.id_bahan
      WHERE produk.produk_id = $produk_id");

  while($rows = $databahan2->fetch_array()){
      $hargaproduk = $hargaproduk+($rows['jumlah']*$rows['harga']);
  }
  $hargaproduk = $hargaproduk+$row["biayaproduk"]+$row["laba"];
?>
<div class="col-md-12">
  <a href="index.php">Daftar Produk</a> > <?= $row["nama_produk"] ?>
</div>
<div class="col-md-12">

</div>
<div class="col-md-12">
  <div class="col-md-12">

  </div>
</div>

<div class="card col-md-12">
  <div class="bg card-img-top heightSepertiga col-md-12" style="margin-top: 10px;background-image: url('admin/data/photos/<?php echo $row['gambar'];?>');">
  </div>
  <div class="card-body col-md-12" style="background-color: white;padding: 20px;">
    <div class="col-md-12" style="text-align:justify">
      <h5 class="card-title"><i class="icon-handbag icons"></i> <?= $row["nama_produk"] ?> &nbsp; &nbsp; <i class="icon-wallet icons"></i>  Rp. <?= number_format($hargaproduk,2,',','.') ?></h5>
      <p style="margin-top: 10px" class="card-text"><?= $row['deskripsi'] ?></p>
      <a
        <?php
          if($isUserLogin){
            $sourcedata = $row;
            $sourcedata['deskripsi'] = "";
            $sourcedata[2] = "";
            ?>
            onclick="onButtonPesan('<?= str_replace('"', "+", json_encode($sourcedata)); ?>')"
            <?php
          } else {
            ?>
            href="login.php"
            <?php
          }
        ?>
        class="btn btn-success" style="margin-top:20px">Pesan Sekarang</a>
    </div>
  </div>
</div>
