<?php
  session_start();
  include "../../koneksi.php";
  include "../helper.php";

  function helper($data, $data2){
    if($data == $data2){
      return true;
    } else {
      return false;
    }
  }

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
  if(isset($_GET['first_date'])){
    $tanggal_awal = $_GET['first_date'];
    $tanggal_akhir = $_GET['last_date'];
    // $id = $_GET['id'];
  } else {
    echo "<script>window.close();</script>";
  }

  if(helper(4, $account->id_level)){
    $query = mysqli_query($h, "SELECT * from purchase_bahan
      JOIN bahan ON purchase_bahan.bahan_id = bahan.bahan_id
      JOIN supplier ON bahan.supplier_id = supplier.supplier_id
      where supplier.supplier_id = $account->supplier_id AND tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
  } else {
    $query = mysqli_query($h, "SELECT * from purchase_bahan
                                JOIN bahan ON purchase_bahan.bahan_id = bahan.bahan_id
                                JOIN supplier ON bahan.supplier_id = supplier.supplier_id
                                WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
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
    <h3>Laporan Pembelian Bahan </h3>
    <hr>
    <br>
    Tanggal : '.parseTanggal($tanggal_awal).' s/d '.parseTanggal($tanggal_akhir).'<br><br>
  	  <table>
  	  	<thead>
  	  		<tr>
            <th align="center" style="text-align:center;width:5px">No</th>
            <th align="center" style="text-align:center;width:80px">Tanggal Pembelian Bahan</th>
            <th align="center" style="text-align:center;width:100px">Bahan</th>
            <th align="center" style="text-align:center;width:70px">Supplier</th>
            <th align="center">Jumlah <br>Pembelian</th>
            <th align="center" style="width:60px">Status</th>
            <th align="center" style="width:60px">Jumlah Biaya</th>
  	  		</tr>
  	  	</thead>
  	  	<tbody>';
        $no = 0;
        $totalbiaya = 0;
        while($row = $query->fetch_array()){
          $totalbiaya += $row['biaya_bahan'];
          if($row['confirmed'] == ""){
            $confirmed = "Belum <br>Dikonfirmasi";
          }else {
            $confirmed = "Dikonfirmasi";
          }
          $no++;
          $html = $html.'<tr class="border-0">
            <td align="center" style="height:20px;text-align:center;width:5px">'.$no.'</td>
            <td align="center">'.parseTanggal($row['tanggal']).'</td>
            <td align="center">'.$row['nama_bahan'].'</td>
            <td align="center">'.$row['nama'].'</td>
            <td align="center">'.$row['jml_kbp'].'</td>
            <td align="center">'.$confirmed.'</td>
            <td align="center">'.'Rp.'.number_format($row['biaya_bahan'],2,',','.').'</td>
          </tr>';
        }
  	  	$html = $html.'
        <tr>
          <td style="height:20px" align="right" colspan="6"><b>Total Biaya &nbsp;</b></td>
          <td align="center">Rp.'.number_format($totalbiaya,2,',','.').'</td>
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

  // $html2pdf = new Html2Pdf('L', 'A4', 'en');
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
