<?php
  $biayabahan = 0;
  if($jumlah_bahan > 0){
    while($row = $databahan2->fetch_array()){
        $biayabahan = $biayabahan+$row['biaya'];
    }
  }
  $biayabahan = $biayabahan*$datas['jml_produksi'];
  $biayaproduksi = ($biayabahan+$datas['biaya_tkl']);
  // $biayaproduksi = $biayabahan
?>

<form action="" method="post" enctype="multipart/form-data">
  <input name="id" type="hidden" class="form-control" value="<?php echo $datas['no_produksi'];  ?>">
  <div class="form-group">
    <label for="inputText3" class="col-form-label">Produk</label>
    <select <?php if($done) echo "disabled"; ?> name="produk_id" class="form-control">
                        <?php
                        while($prod = $produk->fetch_array()){
                          ?>
                              <option value="<?= $prod['produk_id'] ?>"
                                <?php if($prod['produk_id'] == $datas['produk_id']) echo "selected"; ?> >
                                <?= $prod['nama_produk'] ?></option>
                          <?php
                          }
                          ?>
                      </select>

  </div>
  <div class="form-group">
    <label for="inputText3" class="col-form-label">Jumlah Produksi</label>
    <input <?php if($done) echo "disabled"; ?> required name="jml_produksi" type="text" class="form-control" value="<?php echo $datas['jml_produksi'];  ?>">
  </div>
  <div class="form-group">
    <label for="inputText3" class="col-form-label">Tanggal Selesai</label>
    <input <?php if($done) echo "disabled"; ?> required name="tanggal_selesai" id="inputText3" type="date" class="form-control" value="<?php echo $datas['tanggal_selesai'];  ?>">
  </div>
  <div class="form-group">
    <label for="inputText3" class="col-form-label">Biaya Tkl</label>
    <input <?php if($done) echo "disabled"; ?> required name="biaya_tkl" type="text" step="any" class="form-control" value="<?php echo $datas['biaya_tkl'];  ?>" />
  </div>
    <div class="form-group">
      <label for="inputText3" class="col-form-label">Total Biaya Bahan</label>
      <div class="w-100">
        <input disabled name="biaya_tkl" type="text" step="any" class="form-control" value="Rp. <?= number_format($biayabahan,2,',','.')  ?>" />
      </div>
    </div>
    <div class="form-group">
      <label for="inputText3" class="col-form-label">Biaya Produksi</label>
      <div class="w-100">
        <input disabled name="biaya_tkl" type="text" step="any" class="form-control" value="Rp. <?= number_format($biayaproduksi,2,',','.')  ?>" />
      </div>
    </div>

  <div class="custom-file mb-3">
    <?php if(!$done){?>
      <input type="submit" href="#" class="col-xl-4 centerHorizontal btn btn-primary" value="Ubah"></a>
    <?php } ?>
  </div>
</form>
<?php
  if(isset($_POST['id'])){
    $id = $_POST['id'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $jml_produksi = $_POST['jml_produksi'];
    $biaya_tkl = $_POST['biaya_tkl'];
    $produk_id = $_POST['produk_id'];


      $hasil = mysqli_query($h, "UPDATE produksi SET tanggal_selesai = '".$tanggal_selesai."', jml_produksi = '".$jml_produksi."', biaya_tkl = '".$biaya_tkl."', produk_id = '".$produk_id."' WHERE no_produksi= ".$id);

    if($hasil){
        echo "
        <script>
          window.alert('Berhasil mengupdate data produksi');
          window.location='index.php?page=editproduksi&done=false&id=".$id."';
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }else{
        echo "
        <script>
          window.alert('Gagal menambah produksi karena ".mysqli_error($h)."'');
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
  }
?>
