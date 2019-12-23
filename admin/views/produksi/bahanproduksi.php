
<form class="" action="" method="post">
  <div class="form-group card card-footer">
    <label class="col-form-label">Bahan</label>
    <select <?php if($done) echo "disabled"; ?> class="form-control" id="sel1" name="bahan">
      <?php
      while($row = $allbahan->fetch_array()){
      ?>
      <option value='<?= json_encode($row)?>'><?= $row['nama_bahan']?></option>
    <?php } ?>
    </select>
    <div class="form-group">
      <label for="inputText3" class="col-form-label">Jumlah</label>
      <input <?php if($done) echo "disabled"; ?> required name="jumlah" type="number" step="any" class="form-control" value="0" />
    </div>
    <input type="hidden" name="id_produksi" value="<?= $iddata ?>">
    <?php if(!$done){?>
      <input type="submit" href="#" class="marg20-top col-md-12 btn btn-success" value="Tambahkan"></input>
    <?php } ?>
  </div>
</form>

<?php
if($jumlah_bahan == 0){
  ?>
  <center class="marg50-top marg50-bottom">Data bahan belum tersedia </center>
  <?php
} else {
  ?>
  <div class="card">
    <table class="table">
      <thead class="bg-light">
        <tr class="border-0">
          <th class="border-0">Nama Bahan</th>
          <th class="border-0 text-center">Jumlah</th>
          <th class="border-0 text-center">Biaya</th>
          <th class="border-0 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $totalbiaya = 0;
        while($row = $databahan->fetch_array()){
          $totalbiaya = $totalbiaya+$row['biaya'];
          ?>
          <tr>
            <td>
              <?= $row['nama_bahan'] ?>
            </td>

            <td class="text-center">
              <?= $row['jumlah'] ?>
            </td>

            <td class="text-center">
              Rp. <?= number_format($row['biaya'],2,',','.') ?>
            </td>

            <td class="text-center">
              <a href="#"
              onclick="directDelete('index.php?page=editproduksi&done=false&idprod=<?= $iddata ?>&delete=<?php echo $row['id_bahan_produksi']; ?>')"
                <i class="fas fa-trash"></i>
              </a>
            </td>
          </tr>
        <?php }?>
      </tbody>
      <tr>
        <td colspan="2" class="text-right">
          <b>Total Biaya :</b>
        </td>
        <td class="text-center">
          Rp. <?= number_format($totalbiaya,2,',','.') ?>
        </td>
        <td>
        </td>
      </tr>
    </table>
  </div>
  <?php
}


  if(isset($_POST['id_produksi'])){
    $id_produksi = $_POST['id_produksi'];
    $bahan = json_decode($_POST['bahan']);
    $jumlah = $_POST['jumlah'];
    $biaya = $bahan->harga * $jumlah;

    $hasil= mysqli_query($h, "INSERT INTO bahan_produksi(id_bahan, id_produksi, jumlah, biaya)
                              values('$bahan->bahan_id', '$id_produksi', '$jumlah', '$biaya')");
    if($hasil){
        echo "
        <script>
          window.alert('Berhasil menambahkan bahan produksi');
          window.location='index.php?page=editproduksi&done=false&id=".$id_produksi."';
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
