<?php
  include "../../koneksi.php";
  include "../helper.php";

  $koneksi = new Koneksi();
  $h = $koneksi->connect();
  require '../../vendor/autoload.php';
  use Spipu\Html2Pdf\Html2Pdf;
  if(isset($_GET['first_date'])){
    $tanggal_awal = $_GET['first_date'];
    $tanggal_akhir = $_GET['last_date'];
    $produk_id = $_GET['produk_id'];
  } else {
    echo "<script>window.close();</script>";
  }

  $query = mysqli_query($h, "SELECT * from produksi JOIN produk ON produk.produk_id = produksi.produk_id where produk.produk_id = '$produk_id' AND tanggal_selesai BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");

  // echo "SELECT * from produk where produk_id = '$produk_id'";
  setlocale(LC_ALL, "IND");

  // border:1px solid #e3e3e3;
  // width:640px;
  // border-radius: 5px;

  $data = mysqli_fetch_assoc(mysqli_query($h, "SELECT * from produk where produk_id = '$produk_id'"));
  $html = '<!DOCTYPE html>
  <html>
  <head>
    <title>Laporan Produksi</title>
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
    <h3>Laporan Produksi '.$data["nama_produk"].'</h3>
    <hr>
    <br>
    Tanggal : '.parseTanggal($tanggal_awal).' s/d '.parseTanggal($tanggal_akhir).'<br><br>
  	  <table>
  	  	<thead>
  	  		<tr>
            <th align="center" style="width:10px">No</th>
            <th align="center">Tgl Selesai Produksi</th>
            <th align="center" style="width:90px">Nama Produk</th>
            <th align="center">Biaya Per<br>Produksi</th>
            <th align="center">Jumlah<br>Produksi</th>
            <th align="center">Biaya Bahan</th>
            <th align="center">Biaya produksi</th>
  	  		</tr>
  	  	</thead>
  	  	<tbody>';
        $no = 0;

        $allbiayaproduksi = 0;
        $allbiayabahan = 0;
        $allbiayaperproduk = 0;
        while($row = $query->fetch_array()){
          $no++;
          $biayabahan = 0;
          $totalbiayabahan = 0;
          $totalbiayaproduksi = 0;
          $iddata = $row['no_produksi'];
          $databahan2 = mysqli_query($h, "SELECT * from bahan_produksi
              JOIN bahan ON bahan.bahan_id = bahan_produksi.id_bahan
              JOIN produk ON produk.produk_id = bahan_produksi.id_produk
              JOIN produksi ON produksi.produk_id = produk.produk_id
              where no_produksi = '$iddata'");
          $jumlah_bahan = mysqli_num_rows(mysqli_query($h, "SELECT * from bahan_produksi
                                                            JOIN produk ON produk.produk_id = bahan_produksi.id_produk
                                                            JOIN produksi ON produksi.produk_id = produk.produk_id
                                                            WHERE no_produksi = ".$iddata));

          $dataproduk = mysqli_fetch_assoc(mysqli_query($h, "SELECT * from produk
                  JOIN produksi ON produk.produk_id = produksi.produk_id
                  where no_produksi = '$iddata'"));

          if($jumlah_bahan > 0){
            while($rows = $databahan2->fetch_array()){
                $biayabahan = $biayabahan+($rows['jumlah']*$rows['harga']);
            }
          }
          $biayaproduksi = $biayabahan+$dataproduk['biayaproduk'];
          $totalbiayaproduksi = $biayaproduksi*$row['jml_produksi'];
          $totalbiayabahan = $biayabahan*$row['jml_produksi'];

          $allbiayabahan += $totalbiayabahan;
          $allbiayaproduksi += $totalbiayaproduksi;
          $allbiayaperproduk += ($row['biayaproduk']*$row['jml_produksi']);

          $html = $html.'<tr class="border-0">
            <td align="center" style="width:10px;height:15px">'.$no.'</td>
            <td align="center">'.parseTanggal($row['tanggal_selesai']).'</td>
            <td align="center">'.$row['nama_produk'].'</td>
            <td align="center">'.'Rp.'.number_format($row['biayaproduk'],2,',','.').'</td>
            <td align="center">'.$row['jml_produksi'].'</td>
            <td align="center">'.'Rp.'.number_format($totalbiayabahan,2,',','.').'</td>
            <td align="center">'.'Rp.'.number_format($totalbiayaproduksi,2,',','.').'</td>
          </tr>';
        }
  	  	$html = $html.'
        <tr>
          <td align="right" colspan="5"><b>Total Biaya Bahan &nbsp;</b></td>
          <td align="left" colspan="2">Rp.'.number_format($allbiayabahan,2,',','.').'</td>
        </tr>
        <tr>
          <td align="right" colspan="5"><b>Total Biaya Produksi Produk &nbsp;</b></td>
          <td align="left" colspan="2">Rp.'.number_format($allbiayaperproduk,2,',','.').'</td>
        </tr>
        <tr>
          <td align="right" colspan="5"><b>Total Biaya Produksi &nbsp;</b></td>
          <td align="left" colspan="2">Rp.'.number_format($allbiayaproduksi,2,',','.').'</td>
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
     </table>
  </body>
  </html>';

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
