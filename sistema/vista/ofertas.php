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
                        include("../modelo/Oferta.php");

                        $off1 = new Oferta();
                        $off1->conectarBD();
                        $off1->listarOfertas();
                        $off1->cerrarBD();
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