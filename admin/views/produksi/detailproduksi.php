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
