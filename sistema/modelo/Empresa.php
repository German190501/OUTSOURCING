<?php
class Empresa{

    public function conectarBD(){
        $conexion = mysqli_connect("localhost", "root", "", "reclutamiento_v1") or die("Problemas en la conexión");
        return $conexion;
    }

    function llenarListaEmpresa(){
        $registro=mysqli_query($this->conectarBD(), "SELECT * FROM empresas") or die("Problemas en el Select".mysqli_error($this->conectarBD()));
        while($reg=mysqli_fetch_array($registro)){
            echo "<option value=$reg[0]>$reg[1]</option>";
        }
    }

    public function cerrarBD(){
        mysqli_close($this->conectarBD());
    }
}
