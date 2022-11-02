<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pdf/estilos.css">
    <title>OFERTA TRABAJO</title>
</head>

<body>
    <?php

    $nombreImagen = "../recursos/imagenes/IT Outsourcing.png";
    $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));


    $conection = @mysqli_connect("localhost", "root", "", "reclutamiento_v1");

    $pdf_folio = $_REQUEST['pdf_folio'];
    $query = mysqli_query($conection, "SELECT of.*, emp.* FROM ofertas_trabajo of INNER JOIN empresas emp ON of.empresa = emp.id_empresa WHERE folio = $pdf_folio");

    if ($data = mysqli_fetch_array($query)) {
    ?>
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

            }

            .titulo {
                padding: 10px;
                background: #0B5345;
                color: #FFF;
            }

            .titulo h1 {
                font-size: 50px;
            }

            .logo img {
                width: 300px;
            }

            .encabezado p {
                font-size: 18px;
                text-align: justify;
                margin: 20px;
            }

            .membrete h1 {
                font-size: 30px;
                margin-top: 20px;
                margin: 20px;
            }

            .membrete strong {
                color: #154360;
            }

            .descripcion p {
                font-size: 18px;
                text-align: justify;
                margin: 20px;
            }

            .ofrecemos {
                font-size: 18px;
                margin: 20px;
            }

            .ofrecemos ul {
                margin: 20px;
            }

            .perfil_postulado {
                font-size: 18px;
                margin: 20px;
            }

            .fechas {
                font-size: 18px;
                margin: 20px;
            }

            .perfil_postulado ul {
                margin: 20px;
            }
        </style>
        <div class="container">
            <div class="titulo">
                <h1 style="text-align: center;"><strong>CONVOCATORIA 0</strong><?php echo $data['folio'] ?></h1>
            </div>
            <div class="encabezado">
                <p>La empresa <strong><?php echo $data['siglas']; ?></strong> tiene vancantes disponibles para <strong><?php echo $data['puesto']; ?></strong>
                    para realizar trabajos como <strong><?php echo $data['habilidades']; ?></strong> para esto deben tener un nivel alto de conocimiento en <strong><?php echo $data['conocimiento']; ?><strong></p>
            </div>
            <div class="logo" style="text-align: center;">
                <img src="<?php echo $imagenBase64 ?>" alt="">
            </div>

            <div class="membrete">
                <h1">Postulate como <strong><?php echo $data['puesto']; ?></strong></h1>
            </div>

            <div class="descripcion">
                <p><strong><?php echo $data['descripcion']; ?></strong></p>
            </div>

            <div class="ofrecemos">
                <p><strong>Ofrecemos: </strong></p>
                <ul>
                    <li><strong>Salario: </strong><?php echo $data['salario']; ?></li>
                    <li><strong>Horario de Trabajo: </strong><?php echo $data['horario_trabajo']; ?></li>
                    <li><strong>Ubicacion del Trabajo: </strong><?php echo $data['ubicacion_trabajo']; ?></li>
                </ul>
            </div>

            <div class="perfil_postulado">
                <p>Todos los postulados deberan cumplir con el siquiente perfil: </p>
                <ul>
                    <li><strong>Grado Academico: </strong><?php echo $data['grado_academico']; ?></li>
                    <li><strong>Experiencia: </strong><?php echo $data['experiencia']; ?></li>
                    <li><strong>Documentacion: </strong><?php echo $data['requisitos']; ?></li>
                </ul>
            </div>

            <div class="fechas">
                <p style="text-align: center;">Esta convocatoria estara abierta desde el <strong><?php echo $data['fecha_inicio']; ?></strong> hasta el
                    <strong><?php echo $data['fecha_termino']; ?></strong>
                </p>
            </div>
        </div>
    <?php } ?>
    <script src="https://kit.fontawesome.com/69562f358e.js" crossorigin="anonymous"></script>
</body>

</html>
<?php
$html = ob_get_clean();
//echo $html;

    $conection = @mysqli_connect("localhost", "root", "", "reclutamiento_v1");
    
    $pdf_folio = $_REQUEST['pdf_folio'];
    $query = mysqli_query($conection, "SELECT of.*, emp.* FROM ofertas_trabajo of INNER JOIN empresas emp ON of.empresa = emp.id_empresa WHERE folio = $pdf_folio");

    if ($data = mysqli_fetch_array($query)) {
include("PDF.php");

$pdf = new PDF();

$nombre = 'oferta_'.$data['siglas'].'_'.$data['folio'].'.pdf';
$folder = '../archivosPDF/';
$pdf->saveDisk($nombre, $html, $folder);
    }
?>