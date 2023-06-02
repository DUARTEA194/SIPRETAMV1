<!-- Cabecera de la pagina -->
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0">Lista de Maquinas</h1>
    <div>
        <?php if ($_SESSION['RolUsuario'] == "Administrador") : ?>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="modal" data-target="#ModalCargaMasiva"><i class="fas fa-fw fa-plus "></i> Importar registros</a>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target="#ModalRegistroMaquina" onclick="AgregarMaquina()"><i class="fas fa-fw fa-plus "></i> Agregar maquina</a>
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
        <?php endif; ?>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive-xl">
            <table class="table table-sm table-striped table-bordered" id="TablaMaquinas">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Estado</th>
                        <th scope="col" style="max-width:200px" data-name='Acciones'>Operaciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900">
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal de registro-->
<div class="modal fade fade-in" id="ModalRegistroMaquina" tabindex="-1" aria-labelledby="TituloModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModal">Registrar nueva maquina</h5>
                <div>
                    <?php if ($_SESSION['RolUsuario'] == "Administrador") : ?>
                        <button type="submit" class="btn btn-success" id="ButtonAgregarMaquina">Agregar</button>
                        <button type="button" class="btn btn-info d-none" id="ButtonEditarMaquina">Editar</button>
                    <?php endif; ?>
                    <button type="button" class="btn btn-secondary" id="ButtonCancel" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <form id="FormularioRegistroMaquina">
                <div class="modal-body">
                    <div class="row p-2">
                        <div class="col-12 col-sm-12 col-lg-4">
                            <div class="card border">
                                <div class="card-body">
                                    <div id="ContenedorImagen" class="row mb-3">
                                        <div class="input-group">
                                            <img id="InputImagen" src="" alt="Imagen" class="mx-auto my-2" style="max-height:330px">
                                        </div>
                                        <div class="input-group" id="ContenedorNuevaImagen">
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label col-form-label-sm" for="InputNombreMaquina">Nombre</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" id="InputIdMaquina" name="InputIdMaquina">
                                            <input class="form-control form-control-sm text-gray-900" type="text" id="InputNombreMaquina" placeholder="Nombre" name="InputNombreMaquina" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-lg-8">
                            <div class="card border">
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label col-form-label-sm" for="InputCantidadMaquina">Modelo</label>
                                        <div class="col-sm-10">
                                            <input class="form-control form-control-sm text-gray-900" type="text" id="InputModeloMaquina" placeholder="Modelo" name="InputModeloMaquina" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label col-form-label-sm" for="InputEstadoMaquina">Estado</label>
                                        <div class="col-sm-10">
                                            <select name="InputEstadoMaquina" id="InputEstadoMaquina" class="form-control form-control-sm text-gray-900" required>
                                                <option value="" selected hidden>Seleccione el estado de la maquina</option>
                                                <option value="1">Disponible</option>
                                                <option value="2">Mantenimiento</option>
                                                <option value="3">No Disponible</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="InputDescripcion" class="col-sm-2 col-form-label col-form-label-sm">Descripcion</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control text-justify text-gray-900" placeholder="Descripcion de la maquina" id="InputDescripcionMaquina" style="height: 200px"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="InputNombre" class="col-sm-2 col-form-label col-form-label-sm">Observaciones</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control text-gray-900" placeholder="Observaciones de la maquina" id="InputObservacionesMaquina"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
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
                                <th>Nombre</th>
                                <th>Modelo</th>
                                <th>Estado</th>
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