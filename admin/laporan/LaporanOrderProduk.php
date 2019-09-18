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
    $no_order = $_GET['no_order'];
  } else {
    echo "<script>window.close();</script>";
  }

  $query = mysqli_query($h, "SELECT * from orderan JOIN customers ON orderan.customers_id = customers.customers_id where tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
  // echo "SELECT * from produk where produk_id = '$produk_id'";
  setlocale(LC_ALL, "IND");

  // border:1px solid #e3e3e3;
  // width:640px;
  // border-radius: 5px;

  $data = mysqli_fetch_assoc(mysqli_query($h, "SELECT * from orderan where no_order = '$no_order'"));
  $html = '<!DOCTYPE html>
  <html>
  <head>
    <title>Laporan Order Produk</title>
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
      }
      tbody td{
        text-align:center;
        border-top: 1px solid #e3e3e3;
        border-right: 1px solid #e3e3e3;
        padding: 10px;
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
  <h3>Laporan Order Produk '.parseTanggal($data["tanggal"]).'</h3>
  <hr>
  <br>
  Tanggal : '.parseTanggal($tanggal_awal).' s/d '.parseTanggal($tanggal_akhir).'<br><br>
    <table>
      <thead>
        <tr>
          <th class="text-center" style="width:20px">No</th>
          <th class="text-center">Nama Customers</th>
          <th class="text-center">Deskripsi</th>
          <th class="text-center">Tanggal</th>
          <th class="text-center">Total</th>
        </tr>
      </thead>
      <tbody>';
      $no = 0;
      while($row = $query->fetch_array()){
        $no++;
        $html = $html.'<tr class="border-0">
          <td class="text-center" style="width:15px">'.$no.'</td>
          <td align="center">'.$row['nama'].'</td>
          <td align="center">'.$row['deskripsi'].'</td>
          <td align="center" height="30">'.parseTanggal($row['tanggal']).'</td>
          <td align="center">'.'Rp.'.number_format($row['total'],2,',','.').'</td>
        </tr>';
      }
      $html = $html.'</tbody>
    </table>
   </div>
   <div style="width:700px;text-align:center;margin-top:20px">
     ERCM, '.strftime("%d %B %Y").'
     <br><br><br><br><br><br>
     Admin
   </div>

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
