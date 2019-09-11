<?php
  require '../../vendor/autoload.php';
  use Spipu\Html2Pdf\Html2Pdf;


  $html = '<!DOCTYPE html>
  <html>
  <head>
    <title>Laporan Order Produk</title>
    <style type="text/css">
    #outtable{
      padding: 20px;
      border:1px solid #e3e3e3;
      width:960px;
      border-radius: 5px;
    }
      .short{

      }

      table{
        font-family: arial;
        color:#5E5B5C;

      }
      thead th{
        text-align: left;
        padding: 10px;
      }
      tbody td{
        border-top: 1px solid #e3e3e3;
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
    <!-- In production server. If you choose this, then comment the local server and uncomment this one-->
    <!-- <img src="<?php // echo $_SERVER["DOCUMENT_ROOT"]."/media/dist/img/no-signal.png"; ?>" alt=""> -->
    <!-- In your local server -->
    <?php
    setlocale(LC_ALL, "IND");
    ?>


  	<div id="outtable">
  	  <table style="border-color:black">
  	  	<thead>
  	  		<tr>
  	  			<th class="short" style="text-align:center">No</th>
  	  			<th class="normal" style="text-align:center">Kode Booking</th>
  	  			<th class="normal" style="text-align:center;width:140px">Nama Penyewa</th>
  	  			<th class="normal" style="text-align:center">Merk Mobil</th>
  	  			<th class="normal" style="text-align:center">Tanggal Sewa</th>
  	  			<th class="normal" style="text-align:center">Jatuh Tempo</th>
  	  			<th class="normal" style="text-align:center">Kembali</th>

  	  			<th class="normal" style="text-align:center">Biaya</th>
            <th class="normal" style="text-align:center">Keterlambatan</th>
            <th class="normal" style="text-align:center">Denda</th>
  	  		</tr>
  	  	</thead>
  	  	<tbody>
  	  		<?php $no=1; ?>

  	  	</tbody>
  	  </table>
  	 </div>
     <div style="width:700px;text-align:center;margin-top:20px">
       Persewaan Kendaraan, '.strftime("%d %B %Y").'
       <br><br><br><br>
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
?>
