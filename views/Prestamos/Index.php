<div class="card mb-5">
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0">Solicitud de acceso al taller mecánico</h1>
        </div>
        <!--<div class="card">
    <div class="card-body">
        <div class="bg-success text-center">
            <h4 class="text-white">Formulario de Solicitud</h4>
        </div>
        <div class="bodyFormulario"> <!--Cuerpo del formulario
                       <!--    <div class="row CabeceraFormulario"> <!--Primera Parte del formulario de solicitud
                               <!--<div class="col"><strong>Fecha:</strong></div>
                <div class="col"><!-- Seleccio de la fecha programada 
                              
                    <input type="date" name="FechaSeleccionada" id="calendario" value="<?php echo $fcha; ?>" min="<?php echo $fcha; ?>" max="2022-12-31"> <!--El calendario debe de mostrar como fecha inicial la facha actual.Como minimo: La fecha de arranque de semestre y como Final la fecha de termino de semestre
                             <!--      <span class="add-on"><i class="icon-th"></i></span>
                            <!--   </div>
                <div class="col"><strong>Hora:</strong></div>
                <div class="col">
                    <!--Seleccion de la hora programada <!-- Se deben de regir por el horario de trabajo del taller de manufactura
                            <!--       <input type="time" name="HoraSeleccionada" value="<?php echo date('H:i'); ?>" max="20:00" min="08:00">
                </div>
                        <!--   </div>
        <!--</div>
        <div class="bg-success text-center">
                <h4 class="text-white">Motivo de la Solicitud</h4>
            </div>
        <div class="row BodyFormulario">
            <div>
                <div><strong>Materia</strong></div><!--Seleccion de la materia
               <!--<div>
                    <select class="form-select form-select-sm" name="Materia">
                        <option value="" class="OpcionGenerica" disabled selected hidden>Grupo/Materia</option>
                        <option value="0">No estoy inscrito a un grupo</option>
                    </select>
                </div>

                <div><strong>Tipo de tarbajo</strong></div><!--Seleccion del tipo de proyecto
                               <!--<div class="TableInput">
                    <select class="form-select form-select-sm" name="TipoTrabajo">
                        <option value="" class="OpcionGenerica" disabled selected hidden>Tipo de trabajo</option>
                        <option value="1">Tesis</option> <!--todo esto se debe de sustituir
                        <option value="2">Proyecto de asignatura</option> <!--todo esto se debe de sustituir
                        <option value="3">Investigacion</option> <!--todo esto se debe de sustituir
                        <option value="0">Otro</option> <!--todo esto se debe de sustituir
                    </select>
                              <!-- </div>
                <div>
                    <div colspan="4"><textarea name="Descripcion" class="textarea" placeholder="Descripcion del trabajo a realizar"></textarea></div>
                </div>
                </tbody>
                </table>
            </div>
            
            <div class="row ContenedorMaquinasHerramientas">
                <button class="btn btn-success" id="AgregarHerramientas" onclick="HabilitarSeccionHerramientas(); return false;">Agregar Herramientas</button>
                <div id="ContenedorHerramientas">
                    <div id="ContenedorInputBoton">
                        <select class="form-select form-select-sm" id="SelectHerramientas">
                            <option value="" disabled selected hidden>Herramientas...</option>
                        </select>
                        <button class="btn btn-primary" id="BtnAgregarHerramienta" onclick="AddHerramientas(); return false;">Agregar</button>
                        <input type="text" id="InputIdHerramientas" style="display:none;">
                        <input type="text" id="InputSeleccionHerramientas" style="display:none;">
                    </div>
                </div>
            </div>
            <div class="row ContenedorMaquinasHerramientas">
                <h4 class="thTitulo fs-6">Maquinas empleadas</h4>
                <button class="btn btn-success" id="AgregarMaquinas" onclick="HabilitarSeccionMaquinas(); return false;">Agregar Maquinas</button>
                <div id="ContenedorMaquinas">
                    <div id="ContenedorInputBoton">
                        <select class="form-select form-select-sm" id="SelectMaquinas">
                            <option value="" disabled selected hidden>Maquinas...</option>
                        </select>
                        <button class="btn btn-primary" id="BtnAgregarMaquinas" onclick="AddMaquinas(); return false;">Agregar</button>
                        <input type="text" id="InputIdMaquinas" style="display:none;">
                        <input type="text" id="InputSeleccionMaquinas" style="display:none;">
                    </div>
                </div>
            </div>
        <!--</div>
        <div class="bg-success text-center">
                <h4 class="text-white">Herramientas empleadas</h4>
            </div>
        <div class="row">
            <button class="btn btn-success" id="BtnAgregarPrestamo" type="button" data-bs-toggle="modal" data-bs-target="#ModalTerminosCondiciones">Enviar Solicitud <i class="fa fas fa-plus"></i></button>
        </div>
    </div>
</div>-->

        <form id="FormularioPrestamos">
            <div class="form-row">
                <div class="form-group col-md-6">
                <input type="hidden" name="InputFecha" class="form-control form-control-sm text-gray-900" id="InputidUsuario" value="<?php echo $_SESSION['idusuario']?>">
                    <label>Fecha:</label>
                    <?php $fcha = date("Y-m-d", strtotime("+1 day")); ?>
                    <input type="date" name="InputFecha" class="form-control form-control-sm text-gray-900" id="InputFecha" value="<?php echo $fcha; ?>" min="<?php echo $fcha; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Hora:</label>
                    <input type="time" min="09:00:00" max="18:00:00" name="InputHora" class="form-control form-control-sm text-gray-900" id="InputHora" value="<?php echo date('H:i'); ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="InputTipoTrabajo" class="control-label">Tipo de trabajo</label>
                    <select class="form-control form-control-sm text-gray-900" id="InputTipoTrabajo" name="InputTipoTrabajo">
                        <option value="" class="OpcionGenerica" selected hidden>Seleccione un tipo de trabajo</option>
                        <option value="1">Tesis</option>
                        <option value="2">Proyecto de asignatura</option>
                        <option value="3">Investigacion</option>
                        <option value="4">Capitulo estudiantil</option>
                        <option value="5">Trabajo externo</option>
                        <option value="0">Otro</option>
                    </select>
                </div>
                <div class="form-group col-md-8">
                    <label for="InputMateria" class="control-label">Materia:</label>
                    <select class="form-control form-control-sm text-gray-900" id="SelectMateria" name="SelectMateria">
                        <option value="" selected hidden>Seleccione una materia</option>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <textarea class="form-control text-gray-900" placeholder="Descripcion del trabajo a realizar" name="InputDescripcion" id="InputDescripcion"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="text-center border border-secondary rounded p-2">
                        <button type="button" class="btn btn-primary btn-sm" id="BtnHabilitarMaquinas">Agregar Maquinas</button>
                        <div class="mb-2 d-none" id="SeccionMaquinas">
                            <select class="form-control form-control-sm text-gray-900" id="SelectMaquina">
                                <option value="" selected hidden>Lista de Maquinas</option>
                            </select>
                            <button type="button" class="btn btn-primary btn-sm ml-2" id="BtnAgregarMaquinas">Agregar</button>
                        </div>
                        <div>
                            <div>
                                <table class="table table-striped d-none table-sm text-gray-900" id="TablaPrestamoMaquinas">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6 d-none">
                    <div class="text-center border border-secondary rounded p-2">
                        <button type="button" class="btn btn-primary btn-sm" id="BtnHabilitarHerramientas">Agregar Herramientas</button>
                        <div class="mb-2 d-none" id="SeccionHerramientas">
                            <select class="form-control form-control-sm" id="SelectHerramienta">
                                <option value="" selected hidden>Lista de Herramientas</option>
                            </select>
                            <button type="button" class="btn btn-primary btn-sm ml-2" id="BtnAgregarHerramientas">Agregar</button>
                        </div>
                        <div>
                            <table class="table table-stripe d-none table-sm" id="TablaPrestamoHerramientas">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row text-center">
                <!--<button type="button" class="btn btn-primary mx-auto" data-toggle="modal" data-target="#ModalTerminosCondiciones">Enviar solicitud</button>-->
                <button type="button" class="btn btn-primary mx-auto" id="BtnValidarSolicitud">Enviar solicitud</button>
            </div>
        </form>


        <!-- MODAL DE TERMINOS Y CONDICIONES-->
        <div class="modal fade" id="ModalTerminosCondiciones" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">

                    <div class="modal-header p-2">
                        <h5 class="modal-title">Termios y condiciones</h5>
                    </div>
                    <div class="row modal-body">
                        <div class="col-12 col-lg-4 mb-0 border border-1 rounded" id="InfoSolicitud">
                            <p>Informacion del prestamo</p>
                        </div>
                        <div class="col-12 col-lg-8 mb-0 border border-1 rounded">
                            <p>
                                <b>Al aceptar los terminos y condiciones te comprometes a:</b>
                            </p>
                            <p><b>1.-</b> Ingresar con bata y zapato de seguridad (en caso de no tener zapato de seguridad debes usar zapato cerrado).</p>
                            <p><b>2.-</b> Seguir al pie de la letra el reglamento y lineamientos del taller.</p>
                            <p><b>3.-</b> Seguir las indicaciones del técnico asignado.</p>
                            <p><b>4.-</b> Hacerte responsable por el material, herramientas y maquinas que utilices.</p>
                            <p><b>5.-</b> Entregar limpia tanto tu área de trabajo asi como las maquinas y herramientas empleadas</p>
                            <br>
                            <p>Para mas informacion consulta: <a href="http://web.uaemex.mx/gaceta/pdf/gacetas2020/WebDiciembre2020.pdf#page=122" target="_blank">Reglamento de laboratorios y talleres de la UAEMex</a></p><br>
                        </div>
                    </div>
                    <div class="row justify-content-between mb-1">
                        <div class=" col-12 text-center col-lg-8  form-check">
                            <input class="form-check-input" type="checkbox" name="ChkTerminos" id="ChkTerminos">
                            <label class="form-check-label" for="ChkTerminos">
                                Acepto los terminos y condiciones
                            </label>
                        </div>
                        <div class="col-12 col-lg-4 text-center">
                            <button type="button" class="btn btn-sm btn-primary" id="BtnEnviarSolicitud" disabled>Enviar solicitud</button>
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <img src="/assets/img/FRENTE2.jpg" style="width:100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>