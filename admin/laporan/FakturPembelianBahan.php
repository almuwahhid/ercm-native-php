<?php
  session_start();
  include "../../koneksi.php";
  include "../helper.php";


  $koneksi = new Koneksi();
  $h = $koneksi->connect();

  if (!isset($_SESSION['super_user'])){
    echo "<script>window.close();</script>";
    // echo "string";
  } else {
    $account = json_decode($_SESSION['super_user']);
  }

  require '../../vendor/autoload.php';
  use Spipu\Html2Pdf\Html2Pdf;
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    // $id = $_GET['id'];
  } else {
    echo "<script>window.close();</script>";
  }

  if(check_account(4, $account->id_level)){
    $query = mysqli_query($h, "SELECT * from purchase_bahan
      JOIN supplier ON purchase_bahan.supplier_id = supplier.supplier_id
      JOIN produksi ON purchase_bahan.no_produksi = produksi.no_produksi
      JOIN bahan ON purchase_bahan.supplier_id = supplier.supplier_id
      where purchase_bahan.id = '$id'");
    $data = mysqli_fetch_assoc($query);
  } else {
    echo "<script>window.close();</script>";
  }
  // $query = mysqli_query($h, "SELECT * from purchase_bahan JOIN supplier ON purchase_bahan.supplier_id = supplier.supplier_id JOIN produksi ON purchase_bahan.no_produksi = produksi.no_produksi where tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");

  // echo "SELECT * from produk where id = '$id'";
  setlocale(LC_ALL, "IND");

  // border:1px solid #e3e3e3;
  // width:640px;
  // border-radius: 5px;

  // $data = mysqli_fetch_assoc(mysqli_query($h, "SELECT * from purchase_bahan where id = '$id'"));
  $html = '<!DOCTYPE html>
  <html>
  <head>
    <title>Laporan Pembelian Bahan</title>
    <style type="text/css">
    #outtable{
      padding: 20px;

      }
      .short{

      }
      .spans{
        padding-top:5px;
      }
      body{
        font-family: arial;
      }
      .table{
        width : 700px;
        border: 1px solid black;
        font-family: arial;
        color:#5E5B5C;
      }
      thead th{
        text-align: center;
        border-right: 1px solid #e3e3e3;
        padding: 10px;
      }
      tbody td{
        padding: 10px;
      }
      tr{
        font-size: 13px;
      }
      .text-center{
        text-align: : center
      }
    </style>
  </head>
  <body>
    <div id="outtable">
      <h3>FAKTUR ERCM</h3>
      <hr>
      <table style="width : 700px">
        <tr>
          <td style="font-size: 14px;text-align: left;border: 0px;width: 50%">
            <span class="spans">Nama Supplier : '. $account->nama .'</span><br><br>
            <span class="spans">Email : '. $account->email .'</span><br><br>
            <span class="spans">Tanggal Pembelian : '. parseTanggal($data['tanggal']) .'</span>
          </td>
          <td style="font-size: 14px;text-align: left;border: 0px;width: 50%"><span>Alamat : '. $account->alamat .'</span></td>
        </tr>
      </table>
      <br>
      <span><b>Faktur No. : '. nomor_faktur($data['id']) .'</b></span>
      <table class="table" style="width : 600px;margin-top:5px">
        <tbody style="600">
          <tr class="border-0">
            <td style="width:150">Bahan</td>
            <td style="width:10" class="text-center">:</td>
            <td style="width:440">'. $data['nama_bahan'] .'</td>
          </tr>
          <tr class="border-0">
            <td style="width:150px">Harga Satuan</td>
            <td style="width:10px" class="text-center">:</td>
            <td style="width:540px>'. 'Rp.'.number_format($data['harga'],2,',','.') .'</td>
          </tr>
          <tr class="border-0">
            <td style="width:150px">Tanggal Pembelian</td>
            <td style="width:10px" class="text-center">:</td>
            <td style="width:540px>'. parseTanggal($data['tanggal']) .'</td>
          </tr>
          <tr class="border-0">
            <td style="width:150px">Jumlah Pembelian</td>
            <td style="width:10px" class="text-center">:</td>
            <td style="width:200px>'. $data['jml_kbp'] ." ".$data['satuan'].'</td>
          </tr>
          <tr class="border-0">
            <td style="width:150px">Biaya Pembelian</td>
            <td style="width:10px" class="text-center">:</td>
            <td style="width:540px>'. 'Rp.'.number_format($data['biaya_bahan'],2,',','.') .'</td>
          </tr>
        </tbody>
      </table>
     </div>
     <div style="width:700px;text-align:right;margin-top:20px">
       ERCM, '.strftime("%d %B %Y").'
       <br><br><br><br><br><br>
       Admin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     </div>
  </body>
  </html>';

  $html2pdf = new Html2Pdf();
  $html2pdf->writeHTML($html);
  $html2pdf->output();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Laporan Pembelian Bahan</title>
  <style type="text/css">
  #outtable{
    padding: 20px;

    }
    .short{

    }
    body{
      font-family: arial;
    }
    .table{
      border: 1px solid black;
      font-family: arial;
      color:#5E5B5C;
    }
    thead th{
      text-align: center;
      border-right: 1px solid #e3e3e3;
      padding: 10px;
    }
    tbody td{
      padding: 10px;
    }
    tr{
      font-size: 13px;
    }
    .text-center{
      text-align: : center
    }
  </style>
</head>
<body>
  <div id="outtable">
    <h3>FAKTUR ERCM</h3>
    <hr>
    <table style="width : 700px">
      <tr>
        <td style="font-size: 14px;text-align: left;border: 0px;width: 50%">
          <span>Nama Supplier : <?= $account->nama ?></span><br>
          <span>Email : <?= $account->email ?></span><br>
          <span>Tanggal Pembelian : <?= parseTanggal($data['tanggal']) ?></span>
        </td>
        <td style="font-size: 14px;text-align: left;border: 0px;width: 50%"><span>Alamat : <?= $account->alamat ?></span></td>
      </tr>
    </table>
    <br>
    <span>Faktur No. : <?= nomor_faktur($data['id']) ?></span>
    <table class="table" style="width : 700px">
      <tbody>
        <tr class="border-0">
          <td style="width:150px">Bahan</td>
          <td style="width:10px" class="text-center">:</td>
          <td><?= $data['nama_bahan'] ?></td>
        </tr>
        <tr class="border-0">
          <td style="width:150px">Harga Satuan</td>
          <td style="width:10px" class="text-center">:</td>
          <td><?= 'Rp.'.number_format($data['harga'],2,',','.'); ?></td>
        </tr>
        <tr class="border-0">
          <td style="width:150px">Tanggal Pembelian</td>
          <td style="width:10px" class="text-center">:</td>
          <td><?= parseTanggal($data['tanggal']) ?></td>
        </tr>
        <tr class="border-0">
          <td style="width:150px">Biaya Pembelian</td>
          <td style="width:10px" class="text-center">:</td>
          <td><?= 'Rp.'.number_format($data['biaya_bahan'],2,',','.'); ?></td>
        </tr>
        <tr class="border-0">
          <td style="width:150px">Jumlah KBP</td>
          <td style="width:10px" class="text-center">:</td>
          <td><?= $data['jml_kbp'] ?></td>
        </tr>
      </tbody>
    </table>
   </div>
   <div style="width:700px;text-align:right;margin-top:20px">
     ERCM, <?=strftime("%d %B %Y")?>
     <br><br><br><br><br><br>
     Admin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
</body>
</html>
