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

      $pdf->Image('../../../vistas/img/plantilla/etiqueta-caja_link bits.jpg', $pdf->GetX(), $pdf->GetY(), 205, 132);

    }elseif ($marca == 'LINK BITS' and $tipo == 'B') {

      $pdf->Image('../../../vistas/img/plantilla/etiqueta.jpg', $pdf->GetX(), $pdf->GetY(), 205, 132);

    }elseif ($marca == 'MEGALUZ' and $tipo == 'A') {

      $pdf->Image('../../../vistas/img/plantilla/etiqueta-caja_megaluz-14-14.jpg', $pdf->GetX(), $pdf->GetY(), 205, 132);

    }elseif ($marca == 'MEGALUZ' and $tipo == 'B') {

      $pdf->Image('../../../vistas/img/plantilla/etiqueta-megaluz.png', $pdf->GetX(), $pdf->GetY(), 205, 132);

    }elseif ($marca == 'OTRO' and $tipo == 'A') {

      $pdf->Image('../../../vistas/img/plantilla/etiquetas-precio-Negra.png', $pdf->GetX(), $pdf->GetY(), 205, 132);

    }

    /*========================================================================================
      MOSTRANDO FOTO DE LA IMAGEN
    ========================================================================================*/

    $pdf->Image('../../../'.$row['URL_Foto'], $pdf->GetX() +4, $pdf->GetY() + 25, 87, 76);

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
    $pdf->Image($img_file, $pdf->GetX() + 176, $pdf->GetY(), 25, 25);

    /*========================================================================================
      MOSTRANDO CODIGO
    ========================================================================================*/

    $y = $pdf->GetY();

    $x = $pdf->GetX();

    $pdf->SetFont('helvetica', 'B', 37);

    $pdf->Cell(96, 22, $row['cod'], '' , 0, 'C');

    /*========================================================================================
      MOSTRANDO ESPECIFICACION
    ========================================================================================*/

    $pdf->SetY($y +14);

    $pdf->SetX($x +101);

    $pdf->SetFont('helvetica', 'B', 17);
    $pdf->setfillColor(0,0,0);
    $pdf->SetDrawColor(255,255,255);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(97, 9, $row['especificacion'], 1, 0, 'C', 'true');

    /*========================================================================================
      MOSTRANDO DESCIPCION
    ========================================================================================*/

    $pdf->SetTextColor(0,0,0);
    if ($tipo == 'A') {

      $pdf->SetY($y +29);

      $pdf->SetX($x +101);

      $pdf->SetFont('helvetica', 'B', 9.5);

      $pdf->MultiCell(98, 60, $cadenaDescripCorta, 0, 'L');

    }else {

      $pdf->SetY($y +33);

      $pdf->SetX($x +101);

      $pdf->SetFont('helvetica', 'B', 9.5);

      $pdf->MultiCell(98, 60, $cadenaDescripCorta, 0, 'L');

    }

    /*========================================================================================
      MOSTRANDO CODIGO QR
    ========================================================================================*/
    if ($tipo == 'A') {

        $pdf->Image('../../../vistas/img/codigos/'.$row['cod'].'.png', $pdf->GetX() + 158, $pdf->GetY()+14, 25, 25);

    }else {

      $pdf->Image('../../../vistas/img/codigos/'.$row['cod'].'.png', $pdf->GetX() + 154, $pdf->GetY()-1, 35, 35);

    }

    /*========================================================================================
      MOSTRANDO PRECIOS
    ========================================================================================*/
    if ($tipo == 'A') {

      $pdf->SetY($y +90);

      $pdf->SetX($x +101);

      $pdf->SetFont('helvetica', 'B', 22);

      $pdf->Cell(50, 11, '$'.number_format($row['Precio_Menudeo'],2), '' , 0, 'C');


      $pdf->SetY($y +105);

      $pdf->SetX($x +101);

      $pdf->SetFont('helvetica', 'B', 22);

      $pdf->Cell(50, 11, '$'.number_format($row['Precio_Mayoreo'],2), '' , 0, 'C');


      $pdf->SetY($y +119);

      $pdf->SetX($x +101);

      $pdf->SetFont('helvetica', 'B', 22);

      $pdf->Cell(50, 11, '$'.number_format($row['Precio_Caja'],2), '' , 0, 'C');

      /* PRECIO MEMBER */

      $pdf->SetY($y +90);

      $pdf->SetX($x +150);

      $pdf->SetFont('helvetica', 'B', 22);

      $pdf->Cell(50, 11, '$'.number_format($row['MemberPrice'],2), '' , 0, 'C');

    }else {

      $pdf->SetY($y +97);

      $pdf->SetX($x +101);

      $pdf->SetFont('helvetica', 'B', 22);

      $pdf->Cell(50, 12, '$'.number_format($row['Precio_Menudeo'],2), '' , 0, 'C');


      $pdf->SetY($y +116);

      $pdf->SetX($x +101);

      $pdf->SetFont('helvetica', 'B', 22);

      $pdf->Cell(50, 12, '$'.number_format($row['Precio_Mayoreo'],2), '' , 0, 'C');

    }

    /*========================================================================================
      MOSTRANDO PIEZAS DE CAJA
    ========================================================================================*/

    $pdf->SetY($y +105);

    $pdf->SetX($x);

    $pdf->SetFont('helvetica', 'B', 21);

    $pdf->Cell(96, 27, $row['Pieza_Caja'].' pzs / caja master', '' , 0, 'C');

    $pdf->Ln(29);


  }

}
/*========================================================================================
  MOSTRANDO EL NOMBRE DEL ARCHIVO
========================================================================================*/
$pdf->Output('catalogo.pdf', 'I');
?>
