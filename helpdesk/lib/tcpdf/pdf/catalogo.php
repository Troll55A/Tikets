<?php

require_once('tcpdf_include.php');

/*========================================================================================
  NUEVA CLASE DE TCPDF
========================================================================================*/
class PDF extends TCPDF {

  /*========================================================================================
    AGREGANDO CONTENIDO AL HEADER
  ========================================================================================*/
  public function Header(){

    $this->Image('images/tcpdf_logo.jpg', 5, 2, 200);

    $direccion = $_POST['direccion'];

    $this->SetFillColor(156, 154, 167);

    $this->SetTextColor(0, 0, 0, 0);

    $this->SetFont('dejavusans', 'B', 9);

    $this->Cell(190, 51, $direccion, 'T', 0, 'C');
  }

  /*========================================================================================
    AGREGANDO CONTENIDO AL FOOTER
  ========================================================================================*/
  public function Footer() {

  $nombre = $_POST['nombre'];

  $telefono = $_POST['telefono'];

  $this->SetY(-10);

  $this->SetFont('helvetica', 'I', 8);

  $this->Cell(160, 0, $nombre."   "."Tel:". $telefono, 'T', 0, 'C');

  $this->Cell(0, 0, $this->getAliasNumPage(), 'T', 0, 'C');
  }

}
/*========================================================================================
  CONSULTANDO DATOS DEL USUARIO
========================================================================================*/
$id_usuario = $_POST['id_usuario'];

$db = mysqli_connect('localhost' , 'root' , '' , 'helpdesk');

$db->query("SET NAMES 'utf8'");

$consulta = "SELECT id, nombre, telefono, email, foto, sucursal FROM usuarios WHERE id = $id_usuario";

$resultado = mysqli_query($db, $consulta);

$row =mysqli_fetch_array($resultado);

$pdf = new PDF();

$pdf->AddPage();

$pdf->SetFont('dejavusans', 'B', 8);
/*========================================================================================
  AGREGANDO SALTO DE LINEA HEADER
========================================================================================*/
$pdf->SetY(-265);

/*========================================================================================
  CODIGO PARA OBTENER ANCHO Y ALTO DE PDF
========================================================================================*/
$y= $pdf->GetY();

$x = $pdf->GetX();

/*========================================================================================
  CODIGO PARA TRAER IMAGEN
========================================================================================*/
$pdf->SetX(5);
$pdf->Image('../../../'.$row['foto'], $pdf->GetX() + 1, $pdf->GetY() + 1, 18, 18);
$img =

/*========================================================================================
  CODIGO PARA CELDA
========================================================================================*/

$pdf->MultiCell(20, 20, '' , 1, 'C', 0, 0, '', '', true, 0, false, true, 20, 'M');
/*========================================================================================
  CODIGO PARA NOMBRE
========================================================================================*/

$txt ="Nombre:"."\n". $row['nombre'];
$pdf->MultiCell(60, 20, $txt , 1, 'C', 0, 0, '', '', true, 0, false, true, 20, 'M');

/*========================================================================================
  CODIGO PARA TELEFONO
========================================================================================*/
$txt = "Telefono:"."\n" .$row['telefono'];
$pdf->MultiCell(60, 20, $txt , 1, 'C', 0, 0, '', '', true, 0, false, true, 20, 'M');

/*========================================================================================
  CODIGO PARA CORREO
========================================================================================*/

$txt ="Correo:"."\n". $row['email'];
$pdf->MultiCell(60, 20, $txt , 1, 'C', 0, 1, '', '', true, 0, false, true, 20, 'M');

/*========================================================================================
  CODIGO PARA validar sucursal
========================================================================================*/

$sucursalVal = $row['sucursal'];

/*========================================================================================
  CREAMOS VARIABLES CON LOS DATOS DEL FORMULARIO
========================================================================================*/

$arrayClasificacion = $_POST["check"];

$cliente = $_POST["cliente"];

$aumento = $_POST["aumento"];

/*========================================================================================
  CONTADOR DE COLUMNAS
========================================================================================*/
$max = 0;

/*========================================================================================
  sE GENERA CICLO PARA MOSTRRAR CLASIFICACION
========================================================================================*/
for($i = 0; $i < count($arrayClasificacion); $i++) {

  /*========================================================================================
    SE GENERA LA CONSULTA BASADA EN EL LOS DATOS DEL FORMULARIO
  ========================================================================================*/
  if ($_POST["cliente"] == "liquidacion") {

    $queryCont = "SELECT id_Clasific_Produc, COUNT(id_Produc) as contador FROM `Cat_Produc2` where id_Clasific_Produc = ".$arrayClasificacion[$i]." AND Estatus = 1 AND PrecioDesc > 0";

  }else {

    $queryCont = "SELECT id_Clasific_Produc, COUNT(id_Produc) as contador FROM `Cat_Produc2` where id_Clasific_Produc = ".$arrayClasificacion[$i]." AND Estatus = 1";

  }


    $resultadoCont = mysqli_query($db, $queryCont);

    /*========================================================================================
      SE CUENTA EL NUMERO DE FILAS
    ========================================================================================*/
    while($row2 = mysqli_fetch_row($resultadoCont)){

      if($row2[1] > 0){

        $arrayClasificacion2[$i] = $row2[0];

      }else{

        $arrayClasificacion2[$i] = 0;

      }

    }
/*========================================================================================
  CONTADOR DE COLUMNAS
========================================================================================*/
$query1 = "select * from Clasific_Produc where id_Clasific=" . $arrayClasificacion2[$i] . ";";
//var_dump($query1);
$resultado2 = mysqli_query($db, $query1);


/*========================================================================================
  SE GENERA CICLO PARA LOS PRODUCTOS
========================================================================================*/
while ($rows2 = mysqli_fetch_row($resultado2)) {

$pdf->Ln(2);

$pdf->SetX(5);

$pdf->SetFillColor(156, 154, 167);

$idBusqueda = $rows2[0];

$nombreClasificacion = $rows2[1];

$pdf->SetFont('dejavusans', 'B', 11);

/*========================================================================================
  SE MUESTRA EL NOMBRE DE CLASIFICCION DE PRODUCTO
========================================================================================*/

$pdf->MultiCell(200, 10, mb_strtoupper($nombreClasificacion, 'UTF-8'), 1, 'C', 1, 1, '', '', true, 0, false, true, 10, 'M');

/*========================================================================================
  SE GENERA CONSULTA PARA DATOS DE PDF
========================================================================================*/

if ($_POST["cliente"] == "liquidacion" AND $_POST["inventario"] == "todo") {

  $consulta2 = "SELECT P.id_Produc,M.nombre,E.Decripcion,P.Descrip_Corta,P.Variante_Produc,P.PrecioDesc,P.Precio_Menudeo,P.Precio_Mayoreo,P.Precio_Distribuidor,P.Precio_Caja,P.URL_Foto,P.especificacion,P.Pieza_Caja,P.cod,
  P.I_B_P105,P.I_B_VALL, P.I_B_31, P.garantia, P.faturacion, P.iva, P.MemberPrice FROM Cat_Produc2 as P
  INNER JOIN Clasific_Produc as C ON (P.id_Clasific_Produc=C.id_Clasific)
  JOIN Estado_Produc as E on (E.id_Estate_Produc=P.id_Estate_Produc)
  JOIN Marca_Producto as M on (P.Marca_Produc=M.id_Marca) WHERE (P.PrecioDesc > 0) AND P.Estatus = 1 and P.id_Clasific_Produc=$idBusqueda Order by P.Modelo ASC";

}elseif ($_POST["cliente"] == "liquidacion" AND $_POST["inventario"] == "100") {

  $consulta2 = "SELECT P.id_Produc,M.nombre,E.Decripcion,P.Descrip_Corta,P.Variante_Produc,P.PrecioDesc,P.Precio_Menudeo,P.Precio_Mayoreo,P.Precio_Distribuidor,P.Precio_Caja,P.URL_Foto,P.especificacion,P.Pieza_Caja,P.cod,
  P.I_B_FL,P.I_T_CA,P.I_T_NY,P.I_T_WA,P.I_B_COR,P.I_T_FL,P.I_B_P105,P.I_T_NM,P.I_B_AR,P.I_T_AR,P.I_T_IZA,P.I_B_IZA, P.I_B_P100, P.I_B_VALL, P.I_B_31, P.garantia, P.faturacion, P.iva, P.MemberPrice FROM Cat_Produc2 as P
  INNER JOIN Clasific_Produc as C ON (P.id_Clasific_Produc=C.id_Clasific)
  JOIN Estado_Produc as E on (E.id_Estate_Produc=P.id_Estate_Produc)
  JOIN Marca_Producto as M on (P.Marca_Produc=M.id_Marca) WHERE (P.I_B_FL >= 200 OR P.I_T_CA >= 200 OR P.I_T_NY >= 200 OR P.I_T_WA >= 200 OR P.I_B_COR >= 200 OR P.I_T_FL >= 200 OR P.I_B_P105 >= 200 OR P.I_T_NM >= 200 OR
  P.I_B_AR >= 200 OR P.I_T_AR >= 200 OR P.I_T_IZA >= 200 OR P.I_B_IZA >= 200 OR P.I_B_P100 >= 200 OR  P.I_B_VALL >= 200 OR P.I_B_FL >= 200) AND (P.PrecioDesc > 0) AND P.Estatus = 1 AND
  P.id_Clasific_Produc=$idBusqueda Order by P.Modelo ASC";

}elseif ($_POST["cliente"] == "liquidacion" AND $_POST["inventario"] == "pyb") {

  $consulta2 = "SELECT P.id_Produc,M.nombre,E.Decripcion,P.Descrip_Corta,P.Variante_Produc,P.PrecioDesc,P.Precio_Menudeo,P.Precio_Mayoreo,P.Precio_Distribuidor,P.Precio_Caja,P.URL_Foto,P.especificacion,P.Pieza_Caja,P.cod,
  P.I_B_P105,P.I_B_VALL, P.I_B_31, P.garantia, P.faturacion, P.iva, P.MemberPrice FROM Cat_Produc2 as P
  INNER JOIN Clasific_Produc as C ON (P.id_Clasific_Produc=C.id_Clasific)
  JOIN Estado_Produc as E on (E.id_Estate_Produc=P.id_Estate_Produc)
  JOIN Marca_Producto as M on (P.Marca_Produc=M.id_Marca) WHERE P.Estatus = 1 and (P.PrecioDesc > 0) and P.id_Clasific_Produc=$idBusqueda Order by P.Modelo ASC";

}elseif ($_POST["cliente"] == "liquidacion" AND $_POST["inventario"] == "pyb100") {

  $consulta2 = "SELECT P.id_Produc,M.nombre,E.Decripcion,P.Descrip_Corta,P.Variante_Produc,P.PrecioDesc,P.Precio_Menudeo,P.Precio_Mayoreo,P.Precio_Distribuidor,P.Precio_Caja,P.URL_Foto,P.especificacion,P.Pieza_Caja,P.cod,
  P.I_B_P105,P.I_B_VALL,P.I_B_P31, P.garantia, P.faturacion, P.iva, P.MemberPrice FROM Cat_Produc2 as P
  INNER JOIN Clasific_Produc as C ON (P.id_Clasific_Produc=C.id_Clasific)
  JOIN Estado_Produc as E on (E.id_Estate_Produc=P.id_Estate_Produc)
  JOIN Marca_Producto as M on (P.Marca_Produc=M.id_Marca) WHERE (P.I_B_P105 >= 200 OR P.I_B_VALL >= 200) AND (P.PrecioDesc > 0) AND P.Estatus = 1 and P.id_Clasific_Produc=$idBusqueda Order by P.Modelo ASC";

}elseif ($_POST["inventario"] == "todo") {

  $consulta2 = "SELECT P.id_Produc,M.nombre,E.Decripcion,P.Descrip_Corta,P.Variante_Produc,P.PrecioDesc,P.Precio_Menudeo,P.Precio_Mayoreo,P.Precio_Distribuidor,P.Precio_Caja,P.URL_Foto,P.especificacion,P.Pieza_Caja,P.cod,
  P.I_B_FL,P.I_T_CA,P.I_T_NY,P.I_T_WA,P.I_B_COR,P.I_T_FL,P.I_B_P105,P.I_T_NM,P.I_B_AR,P.I_T_AR,P.I_T_IZA,P.I_B_IZA, P.I_B_P100, P.I_B_VALL, P.I_B_31, P.garantia, P.faturacion, P.iva, P.MemberPrice FROM Cat_Produc2 as P
  INNER JOIN Clasific_Produc as C ON (P.id_Clasific_Produc=C.id_Clasific)
  JOIN Estado_Produc as E on (E.id_Estate_Produc=P.id_Estate_Produc)
  JOIN Marca_Producto as M on (P.Marca_Produc=M.id_Marca) WHERE P.Estatus = 1 and P.id_Clasific_Produc=$idBusqueda Order by P.Modelo ASC";

}elseif ($_POST["inventario"] == "200") {

  $consulta2 = "SELECT P.id_Produc,M.nombre,E.Decripcion,P.Descrip_Corta,P.Variante_Produc,P.PrecioDesc,P.Precio_Menudeo,P.Precio_Mayoreo,P.Precio_Distribuidor,P.Precio_Caja,P.URL_Foto,P.especificacion,P.Pieza_Caja,P.cod,
  P.I_B_FL,P.I_T_CA,P.I_T_NY,P.I_T_WA,P.I_B_COR,P.I_T_FL,P.I_B_P105,P.I_T_NM,P.I_B_AR,P.I_T_AR,P.I_T_IZA,P.I_B_IZA, P.I_B_P100, P.I_B_VALL, P.I_B_31, P.garantia, P.faturacion, P.iva, P.MemberPrice FROM Cat_Produc2 as P
  INNER JOIN Clasific_Produc as C ON (P.id_Clasific_Produc=C.id_Clasific)
  JOIN Estado_Produc as E on (E.id_Estate_Produc=P.id_Estate_Produc)
  JOIN Marca_Producto as M on (P.Marca_Produc=M.id_Marca) WHERE (P.I_B_FL >= 200 OR P.I_T_CA >= 200 OR P.I_T_NY >= 200 OR P.I_T_WA >= 200 OR P.I_B_COR >= 200 OR P.I_T_FL >= 200 OR P.I_B_P105 >= 200 OR P.I_T_NM >= 200 OR
  P.I_B_AR >= 200 OR P.I_T_AR >= 200 OR P.I_T_IZA >= 200 OR P.I_B_IZA >= 200 OR P.I_B_P100 >= 200 OR  P.I_B_VALL >= 200 OR  P.I_B_31 >= 200) AND P.Estatus = 1 and P.id_Clasific_Produc=$idBusqueda Order by P.Modelo ASC";

}elseif ($_POST["inventario"] == "pyb") {

  $consulta2 = "SELECT P.id_Produc,M.nombre,E.Decripcion,P.Descrip_Corta,P.Variante_Produc,P.PrecioDesc,P.Precio_Menudeo,P.Precio_Mayoreo,P.Precio_Distribuidor,P.Precio_Caja,P.URL_Foto,P.especificacion,P.Pieza_Caja,P.cod,
  P.I_B_P105,P.I_B_VALL, P.I_B_31, P.garantia, P.faturacion, P.iva, P.MemberPrice FROM Cat_Produc2 as P
  INNER JOIN Clasific_Produc as C ON (P.id_Clasific_Produc=C.id_Clasific)
  JOIN Estado_Produc as E on (E.id_Estate_Produc=P.id_Estate_Produc)
  JOIN Marca_Producto as M on (P.Marca_Produc=M.id_Marca) WHERE (P.I_B_VALL >= 10 OR  P.I_B_31 >= 10 OR P.I_B_P105 >=10) AND P.Estatus = 1 and P.id_Clasific_Produc=$idBusqueda Order by P.Modelo ASC";

}elseif ($_POST["inventario"] == "pyb100") {

  $consulta2 = "SELECT P.id_Produc,M.nombre,E.Decripcion,P.Descrip_Corta,P.Variante_Produc,P.PrecioDesc,P.Precio_Menudeo,P.Precio_Mayoreo,P.Precio_Distribuidor,P.Precio_Caja,P.URL_Foto,P.especificacion,P.Pieza_Caja,P.cod,
  P.I_B_P105,P.I_B_VALL, P.I_B_31, P.garantia, P.faturacion, P.iva, P.MemberPrice FROM Cat_Produc2 as P
  INNER JOIN Clasific_Produc as C ON (P.id_Clasific_Produc=C.id_Clasific)
  JOIN Estado_Produc as E on (E.id_Estate_Produc=P.id_Estate_Produc)
  JOIN Marca_Producto as M on (P.Marca_Produc=M.id_Marca) WHERE (P.I_B_P105 >= 200 OR P.I_B_VALL >= 200 OR P.I_B_31 >= 200) AND P.Estatus = 1 and P.id_Clasific_Produc=$idBusqueda Order by P.Modelo ASC";

}elseif ($_POST["inventario"] == "pyb10") {

  $consulta2 = "SELECT P.id_Produc,M.nombre,E.Decripcion,P.Descrip_Corta,P.Variante_Produc,P.PrecioDesc,P.Precio_Menudeo,P.Precio_Mayoreo,P.Precio_Distribuidor,P.Precio_Caja,P.URL_Foto,P.especificacion,P.Pieza_Caja,P.cod,
  P.I_B_P105,P.I_B_VALL, P.I_B_31, P.garantia, P.faturacion, P.iva, P.MemberPrice FROM Cat_Produc2 as P
  INNER JOIN Clasific_Produc as C ON (P.id_Clasific_Produc=C.id_Clasific)
  JOIN Estado_Produc as E on (E.id_Estate_Produc=P.id_Estate_Produc)
  JOIN Marca_Producto as M on (P.Marca_Produc=M.id_Marca) WHERE (P.I_B_P105 >= 10 OR P.I_B_VALL >= 10 OR  P.I_B_31 >= 10) AND P.Estatus = 1 and P.id_Clasific_Produc=$idBusqueda Order by P.Modelo ASC";

}
$resultado3 = mysqli_query($db, $consulta2);


/*========================================================================================
  SE GENERA CICLO PARA
========================================================================================*/
while ($rows3 = mysqli_fetch_array($resultado3)) {

  /*========================================================================================
    MOSTRAMOS SOLO 4 LINEAS EN EL PDF
  ========================================================================================*/
  $max = $max + 1;

  if(fmod($max, 4) == 0) {

    $pdf->AddPage();

    $pdf->Ln(22);

  }

  /*========================================================================================
    COORDENADAS X PARA TODOS LOS DATOS
  ========================================================================================*/
  $pdf->SetX(5);

  /*========================================================================================
    CONDICION PARA IMAGEN
  ========================================================================================*/
  if ($rows3['URL_Foto'] == '') {

    $img_file = '../../../vistas/img/productos/no-imagen.png';

  }else {

    $img_file = '../../../'.$rows3['URL_Foto'];

  }

  $pdf->SetFont('dejavusans', 'B', 7);

  if ($_POST["tipopdf"] == "catalogo") {

  /*========================================================================================
    MOSTRANDO IMAGEN DE PRODUCTO
  ========================================================================================*/
  $pdf->Image('../../../'.$rows3['URL_Foto'], $pdf->GetX() + 1, $pdf->GetY() + 6, 48, 48);

  if ($rows3['Decripcion'] == 'Liquidación') {
    $pdf->Image('../../../vistas/img/plantilla/liquidacion.png', $pdf->GetX() + 50, $pdf->GetY(), 15, 15);

  }elseif ($rows3['Decripcion'] == 'Novedad') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 50, $pdf->GetY(), 15, 15);

  }elseif ($rows3['Decripcion'] == 'Preventa') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 50, $pdf->GetY(), 15, 15);

  }elseif ($rows3['Decripcion'] == 'Promoción') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 50, $pdf->GetY(), 15, 15);

  }elseif ($rows3['Decripcion'] == 'Línea') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 50, $pdf->GetY(), 15, 15);

  }elseif ($rows3['Decripcion'] == '8% DESC. ADICIONAL SOBRE $MAY.') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 50, $pdf->GetY(), 15, 15);

  }elseif ($rows3['Decripcion'] == '10% DESC. ADICIONAL SOBRE $MAY.') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 50, $pdf->GetY(), 15, 15);

  }elseif ($rows3['Decripcion'] == '12% DESC. ADICIONAL SOBRE $MAY.') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 50, $pdf->GetY(), 15, 15);

  }elseif ($rows3['Decripcion'] == '15% DESC. ADICIONAL SOBRE $MAY.') {
    $pdf->Image('./../../vistas/img/plantilla/', $pdf->GetX() + 50, $pdf->GetY(), 15, 15);

  }elseif ($rows3['Decripcion'] == '18% DESC. ADICIONAL SOBRE $MAY.') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 50, $pdf->GetY(), 15, 15);

  }elseif ($rows3['Decripcion'] == '20% DESC. ADICIONAL SOBRE $MAY.') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 50, $pdf->GetY(), 15, 15);

  }elseif ($rows3['Decripcion'] == 'Agotado') {
    $pdf->Image('../../../vistas/img/plantilla/agotado.png', $pdf->GetX() + 50, $pdf->GetY(), 15, 15);

  }

  $pdf->MultiCell(50, 58, '', 1, 'C', 0, 0, '', '', true, 0, false, true, 58, 'M');

  /*========================================================================================
    VALIDACION SI UN PRODUCTO SE PUEDE FACTURAR, SI CUENTA CON GARANTIA, SI CUENTA CON IVA
  ========================================================================================*/
  if($rows3['garantia']  != '')
  {
    $texto = "\n\n".$rows3['garantia'];
  }else{$texto ="";}
  if($rows3['faturacion'] != '')
  {
    $texto = $texto."\n\n".$rows3['faturacion'];
  }else{$texto = $texto;}
  if($rows3['iva']!='')
  {
    $texto = $texto."\n\n".$rows3['iva'];
  }else{$texto = $texto;}

  /*========================================================================================
    MOSTRANDO DATOS DE PRODUCTO
  ========================================================================================*/
  $text = $rows3['especificacion']."\n"."\n".mb_strtoupper($rows3['Decripcion'], 'UTF-8')."\n"."\n".'MARCA: '.mb_strtoupper($rows3['nombre'], 'UTF-8')."\n"."\n".'PZAS X CAJA: '.$rows3['Pieza_Caja']."\n"."\n".'CODIGO: '.$rows3['cod']. $texto;
  $pdf->MultiCell(45, 58, $text, 1, 'C', 0, 0, '', '', true, 0, false, true, 58, 'M');

  /*========================================================================================
    MOSTRANDO DATOS DE PRODUCTO
  ========================================================================================*/
  $desc  = $rows3['Descrip_Corta'];
  $desc2 = mb_strtoupper($desc, 'UTF-8');
  $arraydescripCorta  = explode("*", $desc2);
  $cadenaDescripCorta = "";
  for ($m = 0; $m < count($arraydescripCorta); $m++) {

    $cadenaDescripCorta = $cadenaDescripCorta . "*" . $arraydescripCorta[$m] . "\n";

    if ($m == 0) {

        $cadenaDescripCorta = $arraydescripCorta[$m];

    }

  }

  $pdf->MultiCell(70, 58, mb_strtoupper($cadenaDescripCorta, 'UTF-8'), 1, 'C', 0, 0, '', '', true, 0, false, true, 58, 'M');

  /*========================================================================================
    VALIDANDO TIPO DE CLIENTE PARA PRECIO
  ========================================================================================*/
if($cliente == "ClienteA") {

  $tipocliente= $rows3['Precio_Menudeo'];

}elseif ($cliente == "ClienteB") {

  $tipocliente= $rows3['Precio_Mayoreo'];

}elseif ($cliente == "ClienteB1") {

  $tipocliente= $rows3['MemberPrice'];

}elseif ($cliente == "ClienteC") {

  $tipocliente= $rows3['Precio_Caja'];

}elseif ($cliente == "ClienteD") {
	if($sucursalVal == '9')
	{
		$mayoreo = $rows3['Precio_Mayoreo'];
  		$caja = $rows3['Precio_Caja'];
  		$tipocliente= $rows3['Precio_Distribuidor'];
	}else
	{
		$tipocliente= $rows3['Precio_Distribuidor'];
	}
  

}elseif ($cliente == "liquidacion") {

  $tipocliente= "Precio May: $".number_format($rows3['Precio_Mayoreo'], 2)."\n\n". "Precio Caja: $".number_format($rows3['Precio_Caja'], 2). "\n\nPrecio Desc: $".number_format($rows3['PrecioDesc'], 2);

}elseif ($cliente == "ClienteBC") {

  $mayoreo = $rows3['MemberPrice'];

  $caja = $rows3['Precio_Caja'];

}elseif ($cliente == "ClienteBC1") {

  $mayoreo = $rows3['Precio_Mayoreo'];

  $caja = $rows3['Precio_Caja'];

}
/*========================================================================================
  VALIDANDO EL AUMENTO
========================================================================================*/
if ($aumento == '' AND $cliente == "ClienteA") {

  $tipocliente= 'Precio : $'.number_format($tipocliente,2);

}elseif ($aumento == '' AND $cliente == "ClienteB") {

  $tipocliente= 'Precio : $'.number_format($tipocliente,2);

}elseif ($aumento == '' AND $cliente == "ClienteB1") {

  $tipocliente= 'Precio : $'.number_format($tipocliente,2);

}elseif ($aumento == '' AND $cliente == "ClienteC") {

  $tipocliente= 'Precio : $'.number_format($tipocliente,2);

}elseif ($aumento == '' AND $cliente == "ClienteD") {
	if($sucursalVal == '9')
	{
		$tipocliente = 'Precio May:'.number_format($mayoreo,2)."\n\n".'Precio Caja:'.number_format($caja,2)."\n\n".'Precio VIP: $'.number_format($tipocliente,2);
	}else
	{
		$tipocliente = 'Precio VIP: $'.number_format($tipocliente,2);
	}
	//$tipocliente = "foraneos";

}elseif ($aumento == '' AND $cliente == "ClienteBC") {

  $tipocliente= 'Precio Member: $'.number_format($mayoreo,2)."\n"."\n"."\n".'Precio Caja: $'.number_format($caja,2);

}elseif ($aumento == '' AND $cliente == "ClienteBC1") {

  $tipocliente= 'Precio Mayoreo: $'.number_format($mayoreo,2)."\n"."\n"."\n".'Precio Caja: $'.number_format($caja,2);

}elseif($aumento !== '' AND $cliente !== "ClienteBC"){

   $tipocliente = 'PRECIO: $'.number_format((($tipocliente * $aumento) / 100)+ $tipocliente. "aqui3",2);

}elseif($aumento !== '' AND $cliente == "ClienteBC"){

  $mayoreo = (($mayoreo * $aumento) / 100)+ $mayoreo;

  $caja = (($caja * $aumento) / 100)+ $caja;

  $tipocliente = 'Precio May: $'.number_format($mayoreo,2)."\n"."\n"."\n".'Precio Caja: $'.number_format($caja,2);

}

  $pdf->MultiCell(35, 58, $tipocliente , 1, 'C', 0, 1, '', '', true, 0, false, true, 58, 'M');

}elseif ($_POST["tipopdf"] == "inventario") {
  /*========================================================================================
    MOSTRANDO INVENTARIO DE SUCURSALES
  ========================================================================================*/
  if ($_POST["inventario"] == "pyb" OR $_POST["inventario"] == "pyb100" OR $_POST["inventario"] == "pyb10") {
    $text = 'I_B_P105: '.$rows3['I_B_P105']."\n"."\n".'I_B_VALL: '.$rows3['I_B_VALL']."\n"."\n".'I_B_P31: '.$rows3['I_B_31'];

  }elseif ($_POST["inventario"] == "todo" OR $_POST["inventario"] == "200") {

    $text = 'I_B_COR: '.$rows3['I_B_COR']."\n"."\n".
            'I_B_P105: '.$rows3['I_B_P105']."\n"."\n".
            'I_B_VALL: '.$rows3['I_B_VALL']."\n"."\n".
            'I_B_31: '.$rows3['I_B_31']."\n"."\n";
  }

  $pdf->MultiCell(47, 58, $text, 1, 'C', 0, 0, '', '', true, 0, false, true, 58, 'M');

  /*========================================================================================
    MOSTRANDO IMAGEN DE PRODUCTO
  ========================================================================================*/

  $pdf->Image('../../../'.$rows3['URL_Foto'], $pdf->GetX() + 1, $pdf->GetY() + 10, 37, 37);
  if ($rows3['Decripcion'] == 'Liquidación') {
    $pdf->Image('../../../vistas/img/plantilla/liquidacion.png', $pdf->GetX() + 40, $pdf->GetY(), 13, 13);

  }elseif ($rows3['Decripcion'] == 'Novedad') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 40, $pdf->GetY(), 13, 13);

  }elseif ($rows3['Decripcion'] == 'Preventa') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 40, $pdf->GetY(), 13, 13);

  }elseif ($rows3['Decripcion'] == 'Promoción') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 40, $pdf->GetY(), 13, 13);

  }elseif ($rows3['Decripcion'] == 'Línea') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 40, $pdf->GetY(), 13, 13);

  }elseif ($rows3['Decripcion'] == '8% DESC. ADICIONAL SOBRE $MAY.') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 40, $pdf->GetY(), 13, 13);

  }elseif ($rows3['Decripcion'] == '10% DESC. ADICIONAL SOBRE $MAY.') {
    $pdf->Image('../../../vistas/img/plantilla/1', $pdf->GetX() + 40, $pdf->GetY(), 13, 13);

  }elseif ($rows3['Decripcion'] == '12% DESC. ADICIONAL SOBRE $MAY.') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 40, $pdf->GetY(), 13, 13);

  }elseif ($rows3['Decripcion'] == '15% DESC. ADICIONAL SOBRE $MAY.') {
    $pdf->Image('./../../vistas/img/plantilla/', $pdf->GetX() + 40, $pdf->GetY(), 13, 13);

  }elseif ($rows3['Decripcion'] == '18% DESC. ADICIONAL SOBRE $MAY.') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 40, $pdf->GetY(), 13, 13);

  }elseif ($rows3['Decripcion'] == '20% DESC. ADICIONAL SOBRE $MAY.') {
    $pdf->Image('../../../vistas/img/plantilla/', $pdf->GetX() + 40, $pdf->GetY(), 13, 13);

  }elseif ($rows3['Decripcion'] == 'Agotado') {
    $pdf->Image('../../../vistas/img/plantilla/agotado.png', $pdf->GetX() + 50, $pdf->GetY(), 15, 15);

  }
  $pdf->MultiCell(39, 58, '', 1, 'C', 0, 0, '', '', true, 0, false, true, 58, 'M');

  /*========================================================================================
    MOSTRANDO DATOS DE PRODUCTO
  ========================================================================================*/
  $text = $rows3['especificacion']."\n"."\n".mb_strtoupper($rows3['Decripcion'], 'UTF-8')."\n"."\n".'MARCA: '.mb_strtoupper($rows3['nombre'], 'UTF-8')."\n"."\n".'PZAS X CAJA: '.$rows3['Pieza_Caja']."\n"."\n".'CODIGO: '.$rows3['cod'];
  $pdf->MultiCell(31, 58, $text, 1, 'C', 0, 0, '', '', true, 0, false, true, 58, 'M');

  /*========================================================================================
    MOSTRANDO DATOS DE PRODUCTO
  ========================================================================================*/
  $desc  = $rows3['Descrip_Corta'];
  $desc2 = mb_strtoupper($desc, 'UTF-8');
  $arraydescripCorta  = explode("*", $desc2);
  $cadenaDescripCorta = "";
  for ($m = 0; $m < count($arraydescripCorta); $m++) {

    $cadenaDescripCorta = $cadenaDescripCorta . "*" . $arraydescripCorta[$m] . "\n";

    if ($m == 0) {

        $cadenaDescripCorta = $arraydescripCorta[$m];

    }

  }

  $pdf->MultiCell(55, 58, mb_strtoupper($cadenaDescripCorta, 'UTF-8'), 1, 'C', 0, 0, '', '', true, 0, false, true, 58, 'M');


  /*========================================================================================
    VALIDANDO TIPO DE CLIENTE PARA PRECIO
  ========================================================================================*/
if($cliente == "ClienteA") {

  $tipocliente= $rows3['Precio_Menudeo'];

}elseif ($cliente == "ClienteB") {

  $tipocliente= $rows3['Precio_Mayoreo'];

}elseif ($cliente == "ClienteC") {

  $tipocliente= $rows3['Precio_Caja'];

}elseif ($cliente == "ClienteD") {

  if($sucursalVal == '9')
	{
		$mayoreo = $rows3['Precio_Mayoreo'];
  		$caja = $rows3['Precio_Caja'];
  		$tipocliente= $rows3['Precio_Distribuidor'];
	}else
	{
		$tipocliente= $rows3['Precio_Distribuidor'];
	}

}elseif ($cliente == "liquidacion") {
	
  	$tipocliente= "Precio May: ".number_format($rows3['Precio_Mayoreo'], 2)."\n\n". "Precio Caja: ".number_format($rows3['Precio_Caja'],2). "\n\nPrecio Desc: ".number_format($rows3['PrecioDesc'], 2);

}elseif ($cliente == "ClienteBC") {

  $mayoreo = $rows3['Precio_Mayoreo'];

  $caja = $rows3['Precio_Caja'];

}
/*========================================================================================
  VALIDANDO EL AUMENTO
========================================================================================*/
if ($aumento == '' AND $cliente == "ClienteA") {

  $tipocliente= 'Precio: $'.number_format($tipocliente,2);

}elseif ($aumento == '' AND $cliente == "ClienteB") {

  $tipocliente= 'Precio: $'.number_format($tipocliente,2);

}
elseif ($aumento == '' AND $cliente == "ClienteC") {

  $tipocliente= 'Precio: $'.number_format($tipocliente,2);

}elseif ($aumento == '' AND $cliente == "ClienteD") {

  if($sucursalVal == '9')
	{
		$tipocliente = 'Precio May:'.number_format($mayoreo,2)."\n\n".'Precio Caja:'.number_format($caja,2)."\n\n".'Precio VIP: $'.number_format($tipocliente,2);
	}else
	{
		$tipocliente = 'Precio VIP: $'.number_format($tipocliente,2);
	}

}elseif ($aumento == '' AND $cliente == "ClienteBC") {

  $tipocliente= 'Precio May: $'.number_format($mayoreo,2)."\n"."\n"."\n".'Precio Caja: $'.number_format($caja,2);

}
elseif($aumento !== '' AND $cliente !== "ClienteBC"){

   $tipocliente = 'PRECIO: $'.number_format((($tipocliente * $aumento) / 100)+ $tipocliente,2);

}elseif($aumento !== '' AND $cliente == "ClienteBC"){

  $mayoreo = (($mayoreo * $aumento) / 100)+ $mayoreo;

  $caja = (($caja * $aumento) / 100)+ $caja;

  $tipocliente = 'Precio May: $'.number_format($mayoreo,2)."\n"."\n"."\n".'Precio Caja: $'.number_format($caja,2);

}

/*========================================================================================
  VALIDANDO EL AUMENTO
========================================================================================*/
  $pdf->MultiCell(28, 58, $tipocliente , 1, 'C', 0, 1, '', '', true, 0, false, true, 58, 'M');
}

}

}

}

$max = $max + 1;

if(fmod($max, 4) == 0) {

  $pdf->AddPage();

  $pdf->Ln(22);

}
$pdf->SetX(5);
/*========================================================================================
  MOSTRANDO TADOS DE PRODUCTO
========================================================================================*/
$pdf->SetFont('dejavusans', 'B', 9);

$pdf->MultiCell(200, 60, "¡¡IMPORTANTE!! "."\n"."*Precios sujetos a cambio sin previo aviso."."\n"."Productos garantizados por defecto de fabrica por 90 días, no cubre daños por mal uso. Para hacer efectiva la garantía deberá presentar el producto en ". $_POST['garantias'].", con ticket original, empaque y accesorios originales. No se realizarán devoluciones de dinero en ningún producto. () En mercancia de liquidación o remate no hay garantía, cambios, ni devoluciones."."\n"."La información de piezas x caja, se refiere únicamente al precio unitario del producto en caso de adquirir una caja del mismo. Cuando el producto es un bafle o un ventilador el número de piezas es 1 en su empaque original. Para fines comerciales, el número en el catálogo hace referencia a la cantidad de piezas que se necesitan para considerar el precio de caja mostrado a la derecha de la lista. \nDebido a las actualizaciones hechas por los fabricantes, es posible que las imágenes difieran del actual producto. pueden ser enviadas versiones nuevas de este producto antes que la imagen sea actualizada." , 0, 'L', 0, 1, '', '', true, 0, false, true, 60, 'M');

$pdf->Output('catalogo.pdf', 'I');

?>