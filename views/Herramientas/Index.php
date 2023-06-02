<!-- Cabecera de la pagina -->
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0">Lista de Herramientas</h1>
    <div>
        <?php if ($_SESSION['RolUsuario'] == "Administrador") : ?>
            <div>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="modal" data-target="#ModalCargaMasiva"><i class="fas fa-fw fa-plus "></i> Importar registros</a>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target="#ModalRegistroHerramienta" onclick="AgregarHerramienta()"><i class="fas fa-fw fa-plus "></i> Agregar herramienta</a>
                <div class="btn-group">
                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-tasks"></i> Operaciones
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <a class="dropdown-item" id="BtnEnviarCorreo">Enviar correo</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive-xl">
            <table class="table table-sm table-striped table-bordered" id="TablaHerramientas" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Estado</th>
                        <th scope="col" style="max-width:150px">Aciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de registro-->

<div class="modal fade" id="ModalRegistroHerramienta" tabindex="-1" aria-labelledby="TituloModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModal">Registrar nueva herramienta</h5>
                <div>
                    <?php if ($_SESSION['RolUsuario'] == "Administrador") : ?>
                        <button type="submit" class="btn btn-success" id="ButtonAgregarHerramienta">Agregar</button>
                        <button type="button" class="btn btn-info d-none" id="ButtonEditarHerramienta">Editar</button>
                    <?php endif; ?>
                    <button type="button" class="btn btn-secondary" id="ButtonCancel" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <form id="FormularioRegistroHerramienta">
                <div class="modal-body">
                    <input type="hidden" id="InputIdHerramienta" name="InputIdHerramienta">

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label col-form-label-sm" for="InputNombreHerramienta">Nombre</label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-sm text-gray-900" type="text" id="InputNombreHerramienta" placeholder="Nombre" name="InputNombreHerramienta" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label col-form-label-sm" for="InputCantidadHerramienta">Cantidad</label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-sm text-gray-900" type="number" id="InputCantidadHerramienta" placeholder="cantidad" name="InputCantidadHerramienta" min="1" title="ingrese solo numeros" required>
                        </div>
                    </div>
                    <div class="row mb-3" id="ContenedorEstado">
                        <label class="col-sm-2 col-form-label col-form-label-sm" for="InputEstadoHerramienta">Estado</label>
                        <div class="col-sm-10">
                            <select name="InputEstadoHerramienta" id="InputEstadoHerramienta" class="form-control form-control-sm text-gray-900" required>
                                <option value="" selected hidden>Seleccione el estado de la herramienta</option>
                                <option value="1">Disponible</option>
                                <option value="2">Mantenimiento</option>
                                <option value="3">No Disponible</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="InputDescripcionHerramienta" class="col-sm-2 col-form-label col-form-label-sm">Descripcion</label>
                        <div class="col-sm-10">
                            <textarea class="form-control text-justify text-gray-900" placeholder="Descripcion de la herramienta" id="InputDescripcionHerramienta" style="height: 100px"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="InputObservacionesHerramienta" class="col-sm-2 col-form-label col-form-label-sm">Observaciones</label>
                        <div class="col-sm-10">
                            <textarea class="form-control text-gray-900" placeholder="Observaciones de la herramienta" id="InputObservacionesHerramienta"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin del Modal de registro-->
<!-- modal carga masiva -->
<div class="modal fade" tabindex="-1" id="ModalCargaMasiva">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Importar registros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col border p-0 rounded">
                        <input class="form-control-file form-control-sm p-1" type="file" id="csv-file-input">
                    </div>
                    <div class="col-2">
                    <button class="btn btn-sm btn-success" id="load-csv-button">Cargar CSV</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="csv-table" class="table table-sm">
                        <thead>
                            <tr>
                                <th>No.Cuenta</th>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th>Correo</th>
                                <th>Semestre</th>
                                <th>Licenciatura</th>
                                <th>Dependencia</th>
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