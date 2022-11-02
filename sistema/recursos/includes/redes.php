<?php
include("../recursos/imageToPdf/vendor/autoload.php");

use \ConvertApi\ConvertApi;

ConvertApi::setApiSecret('ok05MN6BOU9RpUY5');

$msg = "";
$contents = "";
$output = "";
if (isset($_POST["submit"])) {
    $filename = $_FILES["formFile"]["name"];
    $filetype = $_FILES["formFile"]["type"];
    $filetemp = $_FILES["formFile"]["tmp_name"];
    $dir = '../uploads/' . $filename;

    if ($filetype == "application/pdf") {
        move_uploaded_file($filetemp, $dir);
        $result = ConvertApi::convert(
            'png',
            [
                'File' => $dir,
            ],
            'pdf'
        );
        $contents = $result->getFile()->getContents();
        $output = "../converted_files/" . rand() . ".png";
        $fopen = fopen($output, "w");
        fwrite($fopen, $contents);
        fclose($fopen);

        if ($result) {
            $msg = "<div class='alert alert-success'>File converted.</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Something wrong.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Invalid file format.</div>";
    }
}
?>
<div class="modal fade" id="generarimagen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Compartir en redes sociales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <div class="card border p-4 rounded bg-white">
                                <div class="card-body">
                                    <h3 class="card-title mb-3">Convertir PDF a PNG</h3>
                                    <?php echo $msg; ?>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Selecciona tu archivo</label>
                                            <input class="form-control" type="file" id="formFile" name="formFile" required>
                                        </div>
                                        <button class="btn btn-primary" name="submit">Convertir</button>
                                    </form>
                                    <img src="<?php echo $output; ?>" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <a class="bt-facebook btn btn-primary w-100" role="button" href="https://www.facebook.com/sharer/sharer.php?u=https://utnequipo0301.utn.red/reclutamiento_proyectoV1/converted_files/<?php echo $output; ?>">Facebook</a>
                        </div>
                        <div class="col-md-3">
                            <a class="twitter-share-button btn btn-info w-100" role="button" href="https://twitter.com/intent/tweet?text=Para conocer mas ingrese a este sitio: https://utnequipo0301.utn.red/reclutamiento_proyectoV1/converted_files/<?php echo $output; ?>">Tweet</a>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>