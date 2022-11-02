<?php
include("../modelo/Oferta.php");

$off = new Oferta();
$off->conectarBD();
$off->inicializar($_REQUEST['empresa'],$_REQUEST['habilidades'],$_REQUEST['conocimiento'],$_REQUEST['grado_academico'],$_REQUEST['experiencia'],$_REQUEST['puesto'],$_REQUEST['horario_trabajo'],$_REQUEST['descripcion'],$_REQUEST['salario'],$_REQUEST['ubicacion_trabajo'],$_REQUEST['requisitos'],$_REQUEST['fecha_inicio'],$_REQUEST['fecha_termino']);
$off->agregarOferta();
$off->cerrarBD();
?>