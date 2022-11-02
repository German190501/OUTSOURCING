<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("../recursos/includes/scripts.php") ?>
    <title>RECLUTAMIENTO - OFERTAS</title>
</head>

<body>
    <?php include("../recursos/includes/nav.php"); ?>

    <br />
    <h2 class="text-center"><strong>Lista de Ofertas de Trabajo</strong></h2>
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <!--Header de la table-->
                        <div class="row">
                            <div class="col-md-6">
                                <a href="#" class="btn btn-success btn-sm" role="button" data-bs-toggle="modal" data-bs-target="#crearOferta">CREAR OFERTA <li class="fa-solid fa-plus"></li></a>
                                <a href="#" class="btn btn-primary btn-sm" role="button" data-bs-toggle="modal" data-bs-target="#generarimagen">COMPARTIR <li class="fa-solid fa-share-nodes"></li></a>
                            </div>
                            <div class="col-md-6">
                            <form action="../controlador/busqueda.php" method="GET" class="d-flex">
                                    <input class="form-control form-control-sm w-100 me-2" name="busqueda" id="busqueda" type="search" placeholder="Buscar..." aria-label="Search">
                                    <button class="btn btn-outline-dark btn-sm" id="enviar" name="enviar" type="submit">
                                        <li class="fa-solid fa-magnifying-glass"></li>
                                    </button>
                                </form>
                            </div>
                        </div><br />
                        <!--Tabla de CRUD-->
                        <?php
                        $conexion = @mysqli_connect("localhost", "root", "", "reclutamiento_v1");
                        if (isset($_GET['enviar'])) {
                            $busqueda = $_GET['busqueda'];

                            $consulta = $conexion->query("SELECT of.*, emp.* FROM ofertas_trabajo of INNER JOIN empresas emp WHERE of.empresa = emp.id_empresa AND folio LIKE '%$busqueda' ORDER BY folio ASC");

                            echo '<table class="table">
                            <thead>
                                <tr>
                                    <td>Folio</td>
                                    <td>Empresa</td>
                                    <td>Puesto</td>
                                    <td>Fecha Inicio</td>
                                    <td>Fecha termino</td>
                                    <td>Estatus</td>
                                    <td>Acciones</td>
                                </tr>
                            </thead>
                            <tbody>';
                            while ($reg = $consulta->fetch_array()) {
                                echo '<tr>';
                                echo '<td>' . $reg['folio'] . '</td>';
                                echo '<td>' . $reg['siglas'] . '</td>';
                                echo '<td>' . $reg['puesto'] . '</td>';
                                echo '<td>' . $reg['fecha_inicio'] . '</td>';
                                echo '<td>' . $reg['fecha_termino'] . '</td>';
                                if ($reg['estatus'] == 'activa') {
                                    echo '<td class="text-primary">' . $reg['estatus'] . '</td>';
                                } else if ($reg['estatus'] == 'publicada') {
                                    echo '<td class="text-success">' . $reg['estatus'] . '</td>';
                                } else {
                                    echo '<td class="text-warning">' . $reg['estatus'] . '</td>';
                                }
                                echo '<td>
                                <a type="buton" class="btn btn-success btn-sm addPDF" data-bs-toggle="modal" data-bs-target="#agregarPDF"><i class="fa-solid fa-file"></i></a>
                                <a type="buton" class="btn btn-danger btn-sm deleteOffer" data-bs-toggle="modal" data-bs-target="#deleteOffer"><i class="fa-solid fa-trash"></i></a>
                                </td>';
                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                        }
                        ?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>

    <?php include("../recursos/includes/modales.php"); ?>
    <?php include("../recursos/includes/redes.php");?>
    <?php include("../recursos/includes/footer.php"); ?>
    <script>
    $('.addPDF').on('click', function() {
        $tr = $(this).closest('tr');
        var datos = $tr.children("td").map(function() {
            return $(this).text();
        });
        $('#pdf_folio').val(datos[0]);
    });
</script>
</body>

</html>