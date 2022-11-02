<!--Modal Agregar Oferta de Trabajo-->
<div class="modal fade w-100" id="crearOferta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nueva Oferta de Trabajo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../controlador/crearOferta.php" method="post">
                <label for="empresa" class="col-form-label"><strong>Empresa:</strong></label>
                        <select name="empresa" id="empresa" class="form-select">
                            <?php
                            include("../modelo/Empresa.php");

                            $emp = new Empresa();
                            $emp->conectarBD();
                            $emp->llenarListaEmpresa();
                            $emp->cerrarBD();

                            ?>
                        </select>

                    <label for="habilidades" class="col-form-label"><strong>Habilidades:</strong></label>
                    <input type="text" name="habilidades" id="habilidades" placeholder="Menciona tus habilidades" require class="form-control">

                    <label for="conocimiento" class="col-form-label"><strong>Conocimientos:</strong></label>
                    <input type="text" name="conocimiento" id="conocimientos" placeholder="Menciona todos tus conocimientos" require class="form-control">

                    <label for="grado_academico" class="col-form-label"><strong>Grado Academico:</strong></label>
                    <input type="text" name="grado_academico" id="grado_academico" placeholder="Menciona tu grado academico actual" require class="form-control">

                    <label for="experiencia" class="col-form-label"><strong>Experiencia: </strong></label>
                    <input type="text" name="experiencia" id="experiencia" placeholder="Menciona los años de experiencia, ejemplo: 3 años" require class="form-control">

                    <label for="puesto" class="col-form-label"><strong>Puesto:</strong></label>
                    <input type="text" name="puesto" id="puesto" placeholder="Ingrese el puesto que desea" require class="form-control">

                    <label for="horario_trabajo" class="col-form-label"><strong>Horario de Trabajo:</strong></label>
                    <select name="horario_trabajo" id="horario_trabajo" class="form-select">
                        <option value="matutino">Matutino</option>
                        <option value="vespertino">Vespertino</option>
                        <option value="mixto">Mixto</option>
                    </select>

                    <label for="descripcion" class="col-form-label"><strong>Descripcion:</strong></label>
                    <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control" style="min-height: 200px; max-height: 200px;">Coloca la descripcion de tu oferta</textarea>

                    <label for="salario" class="col-form-label"><strong>Salario:</strong></label>
                    <input type="text" id="salario" name="salario" placeholder="Coloca el salario que ofreces" require class="form-control">

                    <label for="ubicacion_trabajo" class="col-form-label"><strong>Ubicacion de Trabajo:</strong></label>
                    <input type="text" name="ubicacion_trabajo" id="ubicacion_trabajo" placeholder="Coloca la ubicacion de tu empresa" require class="form-control">

                    <label for="requisitos" class="col-form-label"><strong>Requisitos:</strong></label>
                    <textarea name="requisitos" id="requesitos" cols="30" rows="10" class="form-control" style="min-height: 200px; max-height: 200px;">Coloca los requisitos de tu oferta</textarea>

                    <label for="fecha_inicio" class="col-form-label"><strong>Fecha de Inicio:</strong></label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" require class="form-control">

                    <label for="fecha_termino" class="col-form-label"><strong>Fecha de Termino:</strong></label>
                    <input type="date" name="fecha_termino" id="fecha_termino" require class="form-control">

                    <br />
                    <input type="submit" class="btn btn-primary w-100" value="GENERAR OFERTA">
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal Generar PDF-->
<div class="modal fade" id="agregarPDF" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><li class="fa-solid fa-plus"></li> Agregar Nueva Oferta de Trabajo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="GET" id="formulario" action="../modelo/generarPDF.php" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4>¿Esta seguro de generar esta oferta de trabajo en un archivo PDF?</h4>
                        <label for="pdf_folio" class="form-label"></label>
                        <input type="hidden" name="pdf_folio" id="pdf_folio" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="butonCrear" id="botonCrear" class="btn btn-success w-100" value="Aceptar">
                        <input type="submit" name="butonDelete" data-dismiss="modal" class="btn btn-danger w-100" value="Cancelar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>