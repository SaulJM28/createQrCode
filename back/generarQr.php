<?php
if (!$_POST) {
  echo 'Don t exiat method post';
} else {
  header('Content-Type: application/json; charset=utf-8');
  $textToQr = $_POST['textToQr'];
 
    include('phpqrcode/qrlib.php');
    $content = $textToQr;
    $nameQR = 'codigoQr-' . $textToQr;
    QRcode::png($content, 'QRS/' . $nameQR . '.png', QR_ECLEVEL_L, 10, 2);

    $data = array(
      "resultado" => true,
      "mensaje" => "Codigo Qr creado",
      "url" => "../generarQr"
    );
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
  
}