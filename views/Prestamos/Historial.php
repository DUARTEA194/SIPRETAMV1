<div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0">Historial de prestamos</h1>
    <div>
    <?php if ($_SESSION['RolUsuario'] == "Administrador") : ?>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="modal" data-target="#ModalCargaMasiva"><i class="fas fa-fw fa-plus "></i> Importar registros</a>
            <div class="btn-group">
                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-tasks"></i> Operaciones
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Activar</a>
                    <a class="dropdown-item" href="#">Cancelar</a>
                    <a class="dropdown-item" href="#">Editar</a>
                </div>
            </div>
        <?php endif; ?>
        <a href="?pagina=NuevaSolicitud" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-fw fa-plus "></i> Nueva solicitud</a>
    </div>
</div>
<div class="card mb-1">
    <div class="card-body">
        <div class="table-responsive-xl">
            <table class="table table-striped table-sm table-bordered" id="table_Solicitudes">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Status</th>
                        <th scope="col">Fecha de registro</th>
                        <th scope="col">Fecha Estimada</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Tipo</th>
                        <th scope="col" data-name='Acciones'>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900">
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal de registro-->
<!--
<div class="modal fade" id="FormularioModal" tabindex="-1" aria-labelledby="TituloModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModal">Registrar nueva Materia</h5>
                <div>
                    <button type="submit" class="btn btn-success" id="ButtonAgregarSolicitud">Actualizar</button>
                    <button type="button" class="btn btn-info d-none" id="ButtonEditarSolicitud">Editar</button>
                    <button type="button" class="btn btn-secondary" id="ButtonCancel" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <div class="modal-body">
                <form id="FormularioPrestamos" autocomplete="off">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="hidden" name="InputIdSolicitud" id="InputIdSolicitud">
                            <label>Status de la solicitud:</label>
                            <input type="text" name="InputStatus" class="form-control form-control-sm text-gray-900" id="InputStatus" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Fecha:</label>
                            <input type="date" name="InputFecha" class="form-control form-control-sm text-gray-900" id="InputFecha" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Hora:</label>
                            <input type="time" name="InputHora" class="form-control form-control-sm text-gray-900" id="InputHora" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="InputMateria" class="control-label">Materia:</label>
                            <select class="form-control form-control-sm text-gray-900" id="SelectMateria" name="SelectMateria">
                                <option value="" selected hidden>Seleccione una materia</option>
                            </select>
                        </div>
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
                        <div class="form-group col-md-12">
                            <textarea class="form-control text-gray-900" placeholder="Descripcion del trabajo a realizar" name="InputDescripcion" id="InputDescripcion"></textarea>
                        </div>
                    </div>
                    <div class="form-row text-center">
                        <div class="form-group col-md-12">
                            <div id="ContendorTablaSolicitud">
                                <table id="TablaElementos" class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>                       
                                </table>
                            </div>
                        </div>
                        <div class="form-group col-md-12 border border-1 d-none p-3" id="ContenedorAgregarMaquinas">
                            <button type="button" class="btn btn-primary btn-sm" id="BtnHabilitarMaquinas">Agregar Maquinas</button>
                            <div class="mb-2 d-none" id="SeccionMaquinas">
                                <select class="form-control form-control-sm" id="SelectMaquina">
                                    <option value="" selected hidden>Lista de Maquinas</option>
                                </select>
                                <button type="button" class="btn btn-primary btn-sm ml-2" id="BtnAgregarMaquinas">Agregar</button>
                            </div>
                            <div>
                            <div class="overflow-auto" style="max-height: 150px;">
                                <table class="table table-striped table-sm d-none" id="TablaPrestamoMaquinas">
                                    <thead class="TablaHeader">
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
                        <div class="form-group col-md-12 border border-1 d-none p-3" id="ContenedorAgregarHerramientas">
                            <button type="button" class="btn btn-primary btn-sm" id="BtnHabilitarHerramientas">Agregar Herramientas</button>
                            <div class="mb-2 d-none" id="SeccionHerramientas">
                                <select class="form-control form-control-sm" id="SelectHerramienta">
                                    <option value="" selected hidden>Lista de Herramientas</option>
                                </select>
                                <button type="button" class="btn btn-primary btn-sm ml-2" id="BtnAgregarHerramientas">Agregar</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal de registro-->
<div class="modal fade" id="FormularioModal" tabindex="-1" aria-labelledby="TituloModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h5 id="TituloModal"></h5>
                <div>
                    <button type="button" class="btn btn-success btn-sm d-none" id="ButtonActivarSolicitud">Activar</button>
                    <button type="submit" class="btn btn-success btn-sm" id="ButtonAgregarSolicitud">Actualizar</button>
                    <button type="button" class="btn btn-info d-none btn-sm" id="ButtonEditarSolicitud">Editar</button>
                    <button type="button" class="btn btn-secondary btn-sm" id="ButtonCancel" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="FormularioPrestamos" autocomplete="off">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header p-0 " id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-center text text-decoration-none text-gray-900" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Datos generales
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input type="hidden" name="InputIdSolicitud" id="InputIdSolicitud">
                                            <label>Status de la solicitud:</label>
                                            <input type="text" name="InputStatus" class="form-control form-control-sm text-gray-900" id="InputStatus" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Fecha:</label>
                                            <input type="date" name="InputFecha" class="form-control form-control-sm text-gray-900" id="InputFecha" value="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Hora:</label>
                                            <input type="time" name="InputHora" class="form-control form-control-sm text-gray-900" id="InputHora" value="">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label for="InputMateria" class="control-label">Materia:</label>
                                            <select class="form-control form-control-sm text-gray-900" id="SelectMateria" name="SelectMateria">
                                                <option value="" selected hidden>Seleccione una materia</option>
                                            </select>
                                        </div>
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
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control text-gray-900" placeholder="Descripcion del trabajo a realizar" name="InputDescripcion" id="InputDescripcion"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0 " id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-center text text-decoration-none text-gray-900" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        Maquinas
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="text-center" id="AlertaMaquinas"></div>
                                    <div id="ContenedorMaquinas">
                                        <div class="text-center p-2 d-none" id="ControlesAgregarMaquinas">
                                            <select class="form-control form-control-sm" id="SelectMaquina">
                                                <option value="" selected hidden>Lista de maquinas</option>
                                            </select>
                                            <button type="button" class="btn btn-primary btn-sm ml-2" id="BtnAgregarMaquina">Agregar</button>
                                        </div>
                                        <div>
                                            <table class="table table-stripe d-none table-sm" id="TablaMaquinas">
                                                <thead class="TablaHeader">
                                                    <tr>
                                                        <th scope="col">id</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Modelo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-0 " id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-center text text-decoration-none text-gray-900" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        Herramientas
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="text-center" id="AlertaHerramientas"></div>
                                    <div id="ContenedorHerramientas">
                                        <div class="text-center p-2 d-none" id="ControlesAgregarHerramientas">
                                            <select class="form-control form-control-sm" id="SelectHerramienta">
                                                <option value="" selected hidden>Lista de Herramientas</option>
                                            </select>
                                            <button type="button" class="btn btn-primary btn-sm ml-2" id="BtnAgregaHerramienta">Agregar</button>
                                        </div>
                                        <div>
                                            <table class="table table-stripe d-none table-sm" id="TablaHerramientas">
                                                <thead class="TablaHeader">
                                                    <tr>
                                                        <th scope="col">id</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Cantidad</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="SolictudFooterStatus">

            </div>

        </div>
    </div>
</div>
<!--
<div id="modal" class="modal" style="display: none;
  position: fixed;
  z-index: 999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.8);">
  <div class="modal-content" style="display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;">
    <!-- Elemento para mostrar la transmisión de la cámara -->
    <!---
    <video id="video-element" autoplay style="width: 100%;
  max-width: 400px;
  height: auto;
  margin-bottom: 20px;"></video>
    <!-- Botón para cerrar el modal -->
    <!--
    <button id="closeModalBtn">Cerrar</button>
  </div>
</div>
<button id="openModalBtn">Abrir Modal</button>
    -->