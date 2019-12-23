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
  } else {
    echo "<script>window.close();</script>";
  }

  $query = mysqli_query($h, "SELECT * from orderan JOIN customers ON orderan.customers_id = customers.customers_id where tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
  // echo "SELECT * from produk where produk_id = '$produk_id'";
  setlocale(LC_ALL, "IND");

  // border:1px solid #e3e3e3;
  // width:640px;
  // border-radius: 5px;
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
  <h3>Laporan Order Produk '.parseTanggal($tanggal_awal).' - '.parseTanggal($tanggal_akhir).'</h3>
  <hr>
  <br>
  Tanggal : '.parseTanggal($tanggal_awal).' s/d '.parseTanggal($tanggal_akhir).'<br><br>
    <table>
      <thead>
        <tr>
          <th align="center" style="width:20px">No</th>
          <th align="center" style="width:150px">Nama Customer</th>
          <th align="center">Tanggal</th>
          <th align="center" style="width:150px">Produk</th>
          <th align="center">Harga</th>
          <th align="center">Jumlah</th>
          <th align="center">Subtotal</th>
          <th align="center">Total</th>
          <th align="center">Total Laba</th>
        </tr>
      </thead>
      <tbody>';
      $no = 0;
      $jumlahTotal = 0;
      $jumlahLaba = 0;
      while($row = $query->fetch_array()){
        $no++;
        $id_detail_order = $row['no_order'];
        $query_order_detail = mysqli_query($h, "SELECT * from order_detail
                                          JOIN orderan ON order_detail.no_order = orderan.no_order
                                          JOIN produk ON order_detail.produk_id = produk.produk_id
                                          WHERE orderan.no_order = '$id_detail_order'
                                          ORDER BY order_detail.hrg_jual ASC");
       $query_order_detail2 = mysqli_query($h, "SELECT * from order_detail
                                    JOIN orderan ON order_detail.no_order = orderan.no_order
                                    JOIN produk ON order_detail.produk_id = produk.produk_id
                                    WHERE orderan.no_order = '$id_detail_order'
                                    ORDER BY order_detail.hrg_jual ASC");
        $total = 0;
        $totalLaba = 0;
        while($rows = $query_order_detail->fetch_array()){
            $total += $rows['subtotal'];
            $totalLaba += ($rows['laba'] * $rows['jumlah']);
        }
        $jumlahTotal = $jumlahTotal+$total;
        $jumlahLaba = $jumlahLaba+$totalLaba;
        $jumlah = mysqli_num_rows(mysqli_query($h, "SELECT * from order_detail
                                          JOIN orderan ON order_detail.no_order = orderan.no_order
                                          JOIN produk ON order_detail.produk_id = produk.produk_id
                                          WHERE orderan.no_order = '$id_detail_order'
                                          ORDER BY order_detail.hrg_jual ASC"));
        $kolom = 0;

        while($rows = $query_order_detail2->fetch_array()){
          $html = $html.'<tr>';
          if($kolom == 0){
            $html = $html.'
            <td rowspan="'.$jumlah.'" align="center" style="width:20px">'.$no.'</td>
            <td rowspan="'.$jumlah.'" align="center">'.$row['nama'].'</td>
            <td rowspan="'.$jumlah.'" align="center" height="20">'.parseTanggal($row['tanggal']).'</td>';
          }
            $html = $html.'
            <td align="center">
              '.$rows['nama_produk'].'
            </td>
            <td align="center">
              Rp.'.number_format($rows['hrg_jual'],2,',','.').'
            </td>
            <td align="center">
              '.$rows['jumlah'].'
            </td>
            <td align="center">
              Rp. '.number_format($rows['subtotal'],2,',','.').'
            </td>';

            if($kolom == 0){
              $kolom = 1;
              $html = $html.'
              <td rowspan="'.$jumlah.'" class="text-center">
                Rp.'.number_format($total,2,',','.').'
              </td>
              <td rowspan="'.$jumlah.'" class="text-center">
                Rp.'.number_format($totalLaba,2,',','.').'
              </td>';
            }
            $html = $html.'</tr>';
        }
      }
      $html = $html.'<tr>
        <td align="right" colspan="7"><b>Omset &nbsp;</b></td>
        <td align="left" colspan="2">Rp.'.number_format($jumlahTotal,2,',','.').'</td>
      </tr>';
      $html = $html.'<tr>
        <td align="right" colspan="7"><b>Laba &nbsp;</b></td>
        <td align="left" colspan="2">Rp.'.number_format($jumlahLaba,2,',','.').'</td>
      </tr>';
      $html = $html.'</tbody>
    </table>
   </div>
   <table style="border:0px">
    <tr>
      <td style=width:780px>
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

  $html2pdf = new Html2Pdf('L', 'A4', 'en');
  // $html2pdf = new Html2Pdf();
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
