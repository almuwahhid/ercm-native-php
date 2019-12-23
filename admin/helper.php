<?php
function parseTanggal($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function nomor_faktur($string){
  switch (strlen($string)) {
    case 1:
      return "000".$string;
      break;

    case 2:
      return "00".$string;
      break;

    case 3:
      return "0".$string;
      break;

    case 4:
      return $string;
      break;

    default:
      return $string;
      break;
  }
}

function check_account($data, $data2){
  if($data == $data2){
    return true;
  } else {
    return false;
  }
}
?>
