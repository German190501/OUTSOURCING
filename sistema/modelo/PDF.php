<?php

use Dompdf\Dompdf;

class PDF{
    public static function saveDisk($nombre, $html, $folder){
        include("../recursos/dompdf/vendor/autoload.php");

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->render();
        $dompdf->stream($nombre, array('Attachment'=>'0'));
        $output = $dompdf->output();
        $file_to_save = $folder.$nombre;

        if(!file_exists($folder)){
            if(mkdir($folder, 0777, true)){
                file_put_contents($file_to_save, $output);
                echo '<script language="javascript" type="text/javascript">                        
                                                        window.location="http://localhost/reclutamiento_proyectoV3/sistema/";
                                                        </script>';
            }
        }else{
            file_put_contents($file_to_save, $output);
            echo '<script language="javascript" type="text/javascript">                        
                                                        window.location="http://localhost/reclutamiento_proyectoV3/sistema/";
                                                        </script>';
        }
    }
}