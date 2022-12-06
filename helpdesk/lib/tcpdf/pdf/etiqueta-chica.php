<?php
require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);

$pdf->AddPage();

/*========================================================================================
  OBTENEMOS LOS DATOS DE LA TABLA
========================================================================================*/
$codigo = $_POST["codigo"];

$marca = $_POST["marca"];

$tipo = $_POST["tipo"];

/*========================================================================================
  CONEXION A LA BASE DE DATOS
========================================================================================*/
$db = mysqli_connect('localhost' , 'root' , '' , 'helpdesk');

$db->query("SET NAMES 'utf8'");

/*========================================================================================
  CICLO PARA MOSTRAR LOS PRODUCTOS
========================================================================================*/
for($i = 0; $i < count($codigo); $i++) {

  /*========================================================================================
    CONSULTA LA BASE DE DATOS
  ========================================================================================*/
  $sql = "SELECT * FROM `Cat_Produc2` where cod = '".$codigo[$i]."'";

  $resultado = mysqli_query($db, $sql);

  /*========================================================================================
    CICLO PARA MOSTRAR LOS PRODUCTOS
  ========================================================================================*/
  while ($row = mysqli_fetch_array($resultado)) {

    /*========================================================================================
      VALIDANDO DESCRIPCION
    ========================================================================================*/

    $descripCorta = $row['Descrip_Corta'];
    $desc = str_replace("\n", '', $descripCorta);
    $desc2 = mb_strtoupper($desc, 'UTF-8');
    $arraydescripCorta  = explode("*", $desc2);
    $cadenaDescripCorta = "";
    for ($m = 0; $m < count($arraydescripCorta); $m++) {

      $cadenaDescripCorta = $cadenaDescripCorta . "*" . $arraydescripCorta[$m] . "\n";

      if ($m == 0) {

      $cadenaDescripCorta = $arraydescripCorta[$m];

      }

    }

    /*========================================================================================
      VALIDANDO FOTO
    ========================================================================================*/

    if ($row['URL_Foto'] == '') {
      $img_file3 = '../../../vistas/img/productos/no-imagen.png';

    }else {

      $img_file3 = '../../../'.$row['URL_Foto'];

    }

    /*========================================================================================
      CICLO PARA MOSTRAR LOS PRODUCTOS
    ========================================================================================*/
    $pdf->SetX(5);

    $pdf->SetFont('dejavusans', 'B', 18);

    /*========================================================================================
      AGREGANDO IMAGEN DE ETIQUETA
    ========================================================================================*/
    if($marca == 'LINK BITS' and $tipo == 'A') {

      $pdf->Image('../../../vistas/img/plantilla/etiqueta-chica-caja_linkbits-27-27.jpg', $pdf->GetX() + 1, $pdf->GetY() + 1, 201, 64.5);

    }elseif ($marca == 'LINK BITS' and $tipo == 'B') {

      $pdf->Image('../../../vistas/img/plantilla/etiqueta-chica-caja_linkbits-31-31.jpg', $pdf->GetX() + 1, $pdf->GetY() + 1, 201, 64.5);

    }elseif ($marca == 'MEGALUZ' and $tipo == 'A') {

      $pdf->Image('../../../vistas/img/plantilla/etiqueta-chica-caja_megaluz-28-28.jpg', $pdf->GetX() + 1, $pdf->GetY() + 1, 201, 64.5);

    }elseif ($marca == 'MEGALUZ' and $tipo == 'B') {

      $pdf->Image('../../../vistas/img/plantilla/etiqueta-chica-caja_megaluz-15-15.jpg', $pdf->GetX() + 1, $pdf->GetY() + 1, 201, 64.5);

    }elseif ($marca == 'OTRO' and $tipo == 'A') {

      $pdf->Image('../../../vistas/img/plantilla/etiquetas-precio-negra-chica.png', $pdf->GetX() + 1, $pdf->GetY() + 1, 201, 64.5);

    }

    /*========================================================================================
      MOSTRANDO FOTO DE LA IMAGEN
    ========================================================================================*/

    $pdf->Image('../../../'.$row['URL_Foto'], $pdf->GetX() + 4, $pdf->GetY() + 6, 55, 55);

    if ($marca !== 'MEGALUZ') {

    if ($row['id_Estate_Produc'] == 1) {

      $img_file = '../../../vistas/img/plantilla/liquidacion.png';

    }elseif ($row['id_Estate_Produc'] == 2) {

      $img_file = '../../../vistas/img/plantilla/';

    }elseif ($row['id_Estate_Produc'] == 3) {

      $img_file = '../../../vistas/img/plantilla/';

    }elseif ($row['id_Estate_Produc'] == 4) {

      $img_file = '../../../vistas/img/plantilla/';

    }elseif ($row['id_Estate_Produc'] == 5) {

      $img_file = '../../../vistas/img/plantilla/';

    }elseif ($row['id_Estate_Produc'] == 6) {

      $img_file = '../../../vistas/img/plantilla/';

    }elseif ($row['id_Estate_Produc'] == 7) {

      $img_file = '../../../vistas/img/plantilla/';

    }elseif ($row['id_Estate_Produc'] == 8) {

      $img_file = '../../../vistas/img/plantilla/';

    }elseif ($row['id_Estate_Produc'] == 9) {

      $img_file = '../../../vistas/img/plantilla/';

    }elseif ($row['id_Estate_Produc'] == 10) {

      $img_file = '../../../vistas/img/plantilla/';

    }elseif ($row['id_Estate_Produc'] == 11) {

      $img_file = '../../../vistas/img/plantilla/';

    }elseif ($row['id_Estate_Produc'] == 28) {

      $img_file = '../../../vistas/img/plantilla/etiqueta-linkbits-agotado.png';

    }
    }elseif ($marca == 'MEGALUZ') {
      if ($row['id_Estate_Produc'] == 1) {

        $img_file = '../../../vistas/img/plantilla/liquidacion-megaluz.png';

      }elseif ($row['id_Estate_Produc'] == 2) {

        $img_file = '../../../vistas/img/plantilla/';

      }elseif ($row['id_Estate_Produc'] == 3) {

        $img_file = '../../../vistas/img/plantilla/';

      }elseif ($row['id_Estate_Produc'] == 4) {

        $img_file = '../../../vistas/img/plantilla/';

      }elseif ($row['id_Estate_Produc'] == 5) {

        $img_file = '../../../vistas/img/plantilla/';

      }elseif ($row['id_Estate_Produc'] == 6) {

        $img_file = '../../../vistas/img/plantilla/';

      }elseif ($row['id_Estate_Produc'] == 7) {

        $img_file = '../../../vistas/img/plantilla/';

      }elseif ($row['id_Estate_Produc'] == 8) {

        $img_file = '../../../vistas/img/plantilla/';

      }elseif ($row['id_Estate_Produc'] == 9) {

        $img_file = '../../../vistas/img/plantilla/';

      }elseif ($row['id_Estate_Produc'] == 10) {

        $img_file = '../../../vistas/img/plantilla/';

      }elseif ($row['id_Estate_Produc'] == 11) {

        $img_file = '../../../vistas/img/plantilla/';

      }elseif ($row['id_Estate_Produc'] == 28) {

        $img_file = '../../../vistas/img/plantilla/etiqueta-agotado-megaluz.png';
  
      }
    }
    $pdf->Image($img_file, $pdf->GetX() + 185, $pdf->GetY(), 15, 15);

    /*========================================================================================
      MOSTRANDO CODIGO
    ========================================================================================*/
    if($tipo == 'A')
    {
      $y = $pdf->GetY();

      $x = $pdf->GetX();
  
      $pdf->SetFont('helvetica', 'B', 14);
  
      $pdf->SetY($y +10);
  
      $pdf->SetX($x +163);
  
      $pdf->Cell(43, 10, $row['cod'], '' , 0, 'C');
    }else{
      $y = $pdf->GetY();

      $x = $pdf->GetX();
  
      $pdf->SetFont('helvetica', 'B', 27);
  
      $pdf->SetY($y +10);
  
      $pdf->SetX($x +63);
  
      $pdf->Cell(43, 10, $row['cod'], '' , 0, 'C');
    }


    /*========================================================================================
      MOSTRANDO ESPECIFICACION
    ========================================================================================*/
    
    $pdf->SetY($y +3);

    $pdf->SetX($x +111);

    $pdf->SetFont('helvetica', 'B', 13);

    $pdf->Cell(89, 6, $row['especificacion'], '' , 0, 'C');

    /*========================================================================================
      MOSTRANDO DESCIPCION
    ========================================================================================*/

      $pdf->SetY($y +12);

      $pdf->SetX($x +111);

      $pdf->SetFont('helvetica', 'B', 8);

      $pdf->MultiCell(58, 48, $cadenaDescripCorta, 0, 'L');


    /*========================================================================================
      MOSTRANDO CODIGO QR
    ========================================================================================*/
      if($tipo == 'A'){
        $pdf->Image('../../../vistas/img/codigos/'.$row['cod'].'.png', $pdf->GetX() + 168, $pdf->GetY()-22, 25, 25);
      }else{
        $pdf->Image('../../../vistas/img/codigos/'.$row['cod'].'.png', $pdf->GetX() + 167, $pdf->GetY()-25, 27, 27);
      }
        

    /*========================================================================================
      MOSTRANDO PRECIOS
    ========================================================================================*/
    if ($tipo == 'A') {

      /* PRECIO MENUDEO */

      $pdf->SetY($y +14);

      $pdf->SetX($x +63);

      $pdf->SetFont('helvetica', 'B', 23);

      $pdf->Cell(43, 10, '$'.number_format($row['Precio_Menudeo'],2), '' , 0, 'C');

      /* PRECIO MAYOREO */

      $pdf->SetY($y +28);

      $pdf->SetX($x +63);

      $pdf->SetFont('helvetica', 'B', 23);

      $pdf->Cell(43, 10, '$'.number_format($row['Precio_Mayoreo'],2), '' , 0, 'C');

      /* PRECIO MEMBER */

      $pdf->SetY($y +41);

      $pdf->SetX($x +63);

      $pdf->SetFont('helvetica', 'B', 23);

      $pdf->Cell(43, 10, '$'.number_format($row['MemberPrice'],2), '' , 0, 'C');

      /* PRECIO CAJA */

      $pdf->SetY($y +54);

      $pdf->SetX($x +63);

      $pdf->SetFont('helvetica', 'B', 23);

      $pdf->Cell(43, 10, '$'.number_format($row['Precio_Caja'],2), '' , 0, 'C');

    }else {

      /* PRECIO MENUDEO B */
      $pdf->SetY($y +22);

      $pdf->SetX($x +63);

      $pdf->SetFont('helvetica', 'B', 23);

      $pdf->Cell(43, 15, '$'.number_format($row['Precio_Menudeo'],2), '' , 0, 'C');

      /*PRECIO MAYOREO B */
      $pdf->SetY($y +36);

      $pdf->SetX($x +63);

      $pdf->SetFont('helvetica', 'B', 23);

      $pdf->Cell(43, 15, '$'.number_format($row['Precio_Mayoreo'],2), '' , 0, 'C');

      /* PRECIO MEMBER */

      $pdf->SetY($y +53);

      $pdf->SetX($x +63);

      $pdf->SetFont('helvetica', 'B', 23);

      $pdf->Cell(43, 10, '$'.number_format($row['MemberPrice'],2), '' , 0, 'C');

    }

    /*========================================================================================
      MOSTRANDO PIEZAS DE CAJA
    ========================================================================================*/
    if($tipo == 'A')
    {
      $pdf->SetY($y +20);

      $pdf->SetX($x + 171);

      $pdf->SetFont('helvetica', 'B', 10);

      $pdf->Cell(29, 15, $row['Pieza_Caja'].' pzs / caja', '' , 0, 'C');

      $pdf->Ln(51);
    }else{
      $pdf->SetY($y +16);

      $pdf->SetX($x + 171);

      $pdf->SetFont('helvetica', 'B', 10);

      $pdf->Cell(29, 15, $row['Pieza_Caja'].' pzs / caja', '' , 0, 'C');

      $pdf->Ln(51);
    }
    

  }

}
/*========================================================================================
  MOSTRANDO EL NOMBRE DEL ARCHIVO
========================================================================================*/
$pdf->Output('catalogo.pdf', 'I');
?>
