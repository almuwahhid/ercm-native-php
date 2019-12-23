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
    if($_GET['process']=="tambah_keranjang"){
      $produk = json_decode($_POST['pesanan_barang']);
      $jumlah_produk = $_POST['jumlah_produk'];

      $query = "SELECT * from orderan where customers_id = '$user->customers_id' AND done = 0";
      $hasil = mysqli_num_rows(mysqli_query($h, $query));
      if($hasil>0){
        $data = mysqli_fetch_assoc(mysqli_query($h, $query));
      } else {
        if(isset($_GET['deskripsi'])){
          $deskripsi = $_GET['deskripsi'];
        } else {
          $deskripsi = "";
        }
        $now = date('Y-m-d');
        $q_orderan = mysqli_query($h, "INSERT INTO orderan(customers_id, deskripsi, tanggal, done, total)
                 values('$user->customers_id','$deskripsi', '$now', '0', '0')");
        if($q_orderan){
          $q_last_orderan = "SELECT * FROM orderan ORDER BY orderan.no_order DESC LIMIT 1";
          $data = mysqli_fetch_assoc(mysqli_query($h, $q_last_orderan));
        }
      }

      $query1 = "SELECT * from order_detail where no_order = '".$data['no_order']."'";
      $isNew = true;

      // echo $query1;
      $q1 = mysqli_query($h, $query1);
      // while($row = $query->fetch_array()){
      while($row = $q1->fetch_array()){
        if($row['produk_id'] == $produk->produk_id){
          $isNew = false;
          $jumlah_produk = $jumlah_produk+$row['jumlah'];
          $old_detail = $row;
        }
      }

      if($isNew){
        $produk_id = $produk->produk_id;
        $produk_harga = ($produk->harga+$produk->laba);
        $noorder = $data['no_order'];
        $subtotal = $jumlah_produk * $produk_harga;
        $t_query = mysqli_query($h, "INSERT INTO order_detail(no_order, produk_id, hrg_jual, jumlah, subtotal)
                  values('$noorder','$produk_id', '$produk_harga', '$jumlah_produk', '$subtotal')");

        if($t_query){
          echo "
          <script>
          window.alert('Berhasil menambahkan ke keranjang');
          window.location='index.php'
          </script>";
        }else{
          echo "INSERT INTO order_detail(no_order, produk_id, hrg_jual, jumlah, subtotal)
                    values('$noorder','$produk_id', '$produk_harga', '$jumlah_produk', '$subtotal')";
          // echo "
          // <script>
          // window.alert('Gagal menambah keranjang ');
          // window.location='index.php'
          // </script>";
        }

      } else {
        $subtotal = $jumlah_produk * ($produk->harga+$produk->laba);
        $t_query = mysqli_query($h, "UPDATE order_detail SET jumlah = '".$jumlah_produk."', subtotal = '".$subtotal."' WHERE no_det= ".$old_detail['no_det']);
        if($t_query){
          echo "
          <script>
          window.alert('Berhasil menambahkan ke keranjang');
          window.location='index.php'
          </script>";
        }else{
          echo "
          <script>
          window.alert('Gagal menambah keranjang ');
          window.location='index.php'
          </script>";
          // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
        }
      }
    } else if($_GET['process']=="konfirmasi"){
      $id = $_GET['id'];
      $t_query = mysqli_query($h, "UPDATE orderan SET done = '1' WHERE no_order = ".$id);
      if($t_query){
        echo "
        <script>
        window.alert('Berhasil mengkonfirmasi pesanan');
        window.location='index.php'
        </script>";
      }else{
        echo "
        <script>
        window.alert('Gagal mengkonfirmasi pesanan ');
        window.location='index.php'
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
    } else if($_GET['process']=="deletedetail"){
      $id = $_GET['id'];
      $id_orderan = $_GET['id_orderan'];
      $del = mysqli_query($h,"DELETE FROM order_detail WHERE no_det = '$id'");
      if ($del) {
        $hasil = mysqli_num_rows(mysqli_query($h, "SELECT * from order_detail where no_order = '$id_orderan'"));
        if($hasil == 0){
          $del = mysqli_query($h,"DELETE FROM orderan WHERE no_order = '$id_orderan'");
          if($del){
            echo "
            <script>
            window.alert('Berhasil menghapus item dari keranjang');
            window.location='index.php'
            </script>";
          } else {
            echo "
            <script>
            window.alert('Gagal menghapus item dari keranjang');
            window.location='index.php'
            </script>";
          }
        }
      }
    } else if($_GET['process']=="update_profile"){
      $id = $_POST['id'];
      $nama = $_POST['nama'];
      $alamat = $_POST['alamat'];
      $telp = $_POST['telp'];

      $t_query = mysqli_query($h, "UPDATE customers SET nama = '".$nama."', alamat = '".$alamat."', telp = '".$telp."' WHERE customers_id= ".$id);
      if($t_query){

        $hasil  =  mysqli_query($h, "SELECT * FROM customers WHERE customers_id = '$id'") or die('Could not look up user information; ' . mysqli_error($h));
        $data = mysqli_fetch_assoc($hasil);
        $_SESSION['ercm_user'] = json_encode($data);

        echo "
        <script>
        window.alert('Berhasil mengedit Akun');
        window.location='index.php'
        </script>";
      } else {
        echo "
        <script>
        window.alert('Gagal mengedit Akun');
        window.location='index.php'
        </script>";
      }
    }
  } else {
    header("Location: index.php");
  }
?>
