<?php
class Oferta{
    private $empresa;
    private $habilidades;
    private $conocimiento;
    private $grado_academico;
    private $experiencia;
    private $puesto;
    private $horario_trabajo;
    private $descripcion;
    private $salario;
    private $ubicacion_trabajo;
    private $requisitos;
    private $fecha_inicio;
    private $fecha_termino;

    public function conectarBD(){
        $conexion = mysqli_connect("localhost", "root", "", "reclutamiento_v1") or die("Problemas en la conexión");
        return $conexion;
    }

    public function inicializar($emp, $hab, $conoc, $gradac, $exp, $puesto, $horario, $descr, $sal, $ubicacion, $requisitos, $inicio, $termino){
        $this->empresa = $emp;
        $this->habilidades = $hab;
        $this->conocimiento = $conoc;
        $this->grado_academico = $gradac;
        $this->experiencia = $exp;
        $this->puesto = $puesto;
        $this->horario_trabajo = $horario;
        $this->descripcion = $descr;
        $this->salario = $sal;
        $this->ubicacion_trabajo = $ubicacion;
        $this->requisitos = $requisitos;
        $this->fecha_inicio = $inicio;
        $this->fecha_termino = $termino;
    }

    public function agregarOferta(){
        mysqli_query($this->conectarBD(),  "INSERT INTO ofertas_trabajo(empresa,habilidades,conocimiento,grado_academico,experiencia,puesto,horario_trabajo,descripcion,salario,ubicacion_trabajo,requisitos,fecha_inicio,fecha_termino) 
                                            VALUES($this->empresa,'$this->habilidades','$this->conocimiento','$this->grado_academico','$this->experiencia','$this->puesto','$this->horario_trabajo','$this->descripcion','$this->salario','$this->ubicacion_trabajo','$this->requisitos','$this->fecha_inicio','$this->fecha_termino')") 
                                            or die("Problemas al agregar".mysqli_error($this->conectarBD()));
        echo '<script language="javascript" type="text/javascript">                        
        alert("Convocoatoria creada correctamente");
        window.location="http://localhost/reclutamiento_proyectoV1/vista/index.php";
        </script>';
    }

    public function listarOfertas(){
        $registros = mysqli_query($this->conectarBD(),"SELECT of.*, emp.* FROM ofertas_trabajo of INNER JOIN empresas emp WHERE of.empresa = emp.id_empresa ORDER BY folio ASC")
        or die ("Problemas en el select.".mysqli_error($this->conectarBD()));

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
        <tbody>' ;
        while($reg = mysqli_fetch_array($registros)){
            echo '<tr>';
            echo '<td>'.$reg['folio'].'</td>';
            echo '<td>'.$reg['siglas'].'</td>';
            echo '<td>'.$reg['puesto'].'</td>';
            echo '<td>'.$reg['fecha_inicio'].'</td>';
            echo '<td>'.$reg['fecha_termino'].'</td>';
            if($reg['estatus'] == 'activa'){
                echo '<td class="text-primary">'.$reg['estatus'].'</td>';
            }else if($reg['estatus'] == 'publicada'){
                echo '<td class="text-success">'.$reg['estatus'].'</td>';
            }else{
                echo '<td class="text-warning">'.$reg['estatus'].'</td>';
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

    public function mostrarOfertas(){
            $registros = mysqli_query($this->conectarBD(),"SELECT of.*, emp.* FROM ofertas_trabajo of INNER JOIN empresas emp WHERE of.empresa = emp.id_empresa AND estatus = 'activa' ORDER BY folio ASC")
            or die ("Problemas en el select.".mysqli_error($this->conectarBD()));

            while($reg = mysqli_fetch_array($registros)){
                echo '<div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                  <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary">'.$reg['siglas'].'</strong>
                    <h3 class="mb-0">'.$reg['puesto'].'</h3>
                    <div class="mb-1 text-muted">'.$reg['fecha_inicio'].'-'.$reg['fecha_termino'].'</div>
                    <p class="card-text mb-auto">'.$reg['descripcion'].'</p>
                    <a href="#" class="btn btn-outline-primary">VER OFERTA</a>
                  </div>
                  <div class="col-auto d-none d-lg-block">
                      <img src="sistema/recursos/imagenes/office.jpg" class="bd-placeholder-img" width="200" height="250" alt="">
                  </div>
                </div>
              </div>';
            }
    }

    public function cerrarBD(){
        mysqli_close($this->conectarBD());
    }
}
?>