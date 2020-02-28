<?php
  include "../../koneksi.php";
  include "../helper.php";
  require '../../vendor/autoload.php';
  use Spipu\Html2Pdf\Html2Pdf;

  $koneksi = new Koneksi();
  $h = $koneksi->connect();
  if(isset($_GET['no_produksi'])){
    $no_produksi = $_GET['no_produksi'];
  } else {
    echo "<script>window.close();</script>";
  }

  setlocale(LC_ALL, "IND");

  // $query = ;
  $querybahan = mysqli_query($h, "SELECT * from bahan_produksi
      JOIN bahan ON bahan.bahan_id = bahan_produksi.id_bahan
      JOIN produk ON produk.produk_id = bahan_produksi.id_produk
      JOIN produksi ON produksi.produk_id = produk.produk_id
      where no_produksi = '$no_produksi'");

  $jumlah_bahan = mysqli_num_rows(mysqli_query($h, "SELECT * from bahan_produksi
                                                    JOIN produk ON produk.produk_id = bahan_produksi.id_produk
                                                    JOIN produksi ON produksi.produk_id = produk.produk_id
                                                    WHERE no_produksi = ".$no_produksi));
  $data = mysqli_fetch_assoc(mysqli_query($h, "SELECT * from produksi JOIN produk ON produksi.produk_id = produk.produk_id WHERE no_produksi = '$no_produksi'"));
  $dataproduk = mysqli_fetch_assoc(mysqli_query($h, "SELECT * from produk
          JOIN produksi ON produk.produk_id = produksi.produk_id
          where no_produksi = '$no_produksi'"));
  // border:1px solid #e3e3e3;
  // width:640px;
  // border-radius: 5px;


  $html = '<!DOCTYPE html>
  <html>
  <head>
    <title>Faktur Produksi</title>
    <style type="text/css">
    #outtable{
      padding: 20px;

      }
      .short{

      }
      table{
        border: 1px solid black;
        font-family: arial;
        color:#5E5B5C;
      }
      thead th{
        text-align: center;
        border-right: 1px solid #e3e3e3;
        padding: 10px;
        display: inline-block;
        vertical-align: middle;
        line-height: normal;
      }
      tbody td{
        text-align:center;
        border-top: 1px solid #e3e3e3;
        border-right: 1px solid #e3e3e3;
        padding: 10px;
        display: inline-block;
        vertical-align: middle;
        line-height: normal;
      }
      tbody tr:nth-child(even){
        background: #F6F5FA;
      }
      tr{
        font-size: 12px;
      }
      tbody tr:hover{
        background: #EAE9F5
      }
      .text-center{
        text-align: : center
      }
    </style>
  </head>
  <body>
  	<div id="outtable">
    <h3>Faktur Produksi '.$data["nama_produk"].'</h3>
    <hr>
    <br>';
    if($jumlah_bahan == 0){
      $html = $html.'<center class="marg50-top marg50-bottom">Data bahan belum tersedia </center>';
    } else {
      $html = $html.'<table>
    	  	<thead>
    	  		<tr>
              <th align="center" style="width:10px">No</th>
              <th class="border-0">Nama Bahan</th>
              <th class="border-0">Harga</th>
              <th class="border-0 text-center">Jumlah</th>
              <th align="center" class="border-0 text-center">Biaya</th>
    	  		</tr>
    	  	</thead>
    	  	<tbody>';
          $no = 0;
          $totalbiaya = 0;
          $biayabahan = 0;
          while($row = $querybahan->fetch_array()){
            $no++;
            $biayabahan = $biayabahan+($row['harga']*$row['jumlah']);

            $html = $html.'<tr class="border-0">
              <td align="center" style="width:10px;height:15px">'.$no.'</td>
              <td align="center" style="width:250px">'.$row['nama_bahan'].'</td>
              <td align="center" style="width:100px">'.'Rp.'.number_format($row['harga'],2,',','.').'</td>
              <td align="center">'.$row['jumlah'].'</td>
              <td align="center" style="width:100px">'.'Rp.'.number_format($row['harga']*$row['jumlah'],2,',','.').'</td>
            </tr>';
          }
          $totalbiaya = ($biayabahan+$dataproduk['biayaproduk'])*$data['jml_produksi'];

    	  	$html = $html.'
          <tr>
            <td align="right" colspan="4"><b>Jumlah Produksi &nbsp;</b></td>
            <td align="left">'.$data["jml_produksi"].'</td>
          </tr>
          <tr>
            <td align="right" colspan="4"><b>Biaya Produksi per Produk &nbsp;</b></td>
            <td align="left">Rp.'.number_format($dataproduk['biayaproduk'],2,',','.').'</td>
          </tr>
          <tr>
            <td align="right" colspan="4"><b>Total Biaya Bahan &nbsp;</b></td>
            <td align="left">Rp.'.number_format($biayabahan,2,',','.').'</td>
          </tr>
          <tr>
            <td align="right" colspan="4"><b>Total Biaya Produksi &nbsp;</b></td>
            <td align="left">Rp.'.number_format($totalbiaya,2,',','.').'</td>
          </tr>
          </tbody>
    	  </table>
    	 </div>
       <table style="border:0px">
        <tr>
          <td style=width:450px>
          </td>
          <td style="width:30%">
          <div style="width:300px;text-align:center;margin-top:20px">
            ERCM, '.strftime("%d %B %Y").'
            <br><br><br><br><br><br>
            Admin
          </div>
          </td>
        </tr>
       </table>';
    }
    $html = $html.'</body></html>';

// echo $html;
  $html2pdf = new Html2Pdf();
  $html2pdf->writeHTML($html);
  $html2pdf->output();
//buat page number
//       $font = $dompdf->getFontMetrics()->get_font("Arial", "bold");
//       $dompdf->getCanvas()->page_text(420, 550, "Page {PAGE_NUM}/{PAGE_COUNT}", $font, 10, array(0,0,0));
//       ob_end_clean();
//
// $dompdf->stream(''.$namefile, array('Attachment'=>0));
// $output = $dompdf->output();
// file_put_contents('directory/'.$namefile, $output);
?>
