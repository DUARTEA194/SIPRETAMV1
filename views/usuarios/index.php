<!-- Cabecera de la pagina -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0">Lista de Usuarios</h1>
    <div>
        <?php if ($_SESSION['RolUsuario'] == "Administrador") : ?>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="modal" data-target="#ModalCargaMasiva"><i class="fas fa-fw fa-plus "></i> Importar registros</a>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target="#FormularioModal" onclick="AgregarUsuario()"><i class="fas fa-fw fa-plus "></i> Agregar usuario</a>

            <div class="btn-group">
                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-tasks"></i> Operaciones
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Eliminar</a>
                    <a class="dropdown-item" href="#">Editar</a>
                    <a class="dropdown-item" id="BtnEnviarCorreo">Enviar correo</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>
<div class="card mb-1">
    <div class="card-body">
        <div class="table-responsive-xl">
            <table class="table table-sm table-striped table-sm table-bordered" id="TablaUsuarios" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">NoCuenta</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Rol</th>
                        <th scope="col">CorreoInstitucional</th>
                        <th scope="col">Semestre</th>
                        <th scope="col">Licenciatura</th>
                        <th scope="col">Dependencia</th>
                        <?php if ($_SESSION['RolUsuario'] == "Administrador") : ?>
                            <th scope="col" style="min-width:50px" data-name='Acciones'>Operaciones</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="text-gray-900">
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal de registro-->

<div class="modal fade" id="FormularioModal" tabindex="-1" aria-labelledby="TituloModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModal">Registrar nuevo usuario</h5>
                <div>
                    <button type="submit" class="btn btn-success" id="ButtonAgregarUsuario">Agregar</button>
                    <button type="button" class="btn btn-info d-none" id="ButtonEditarUsuario">Editar</button>
                    <button type="button" class="btn btn-secondary" id="ButtonCancel" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <form id="FormularioRegistroUsuario">
                <div class="modal-body">
                    <div class="row p-2">
                        <div class="col col-sm-12 col-mb-4 col-lg-9">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="InputTipoUsuario" class="col-form-label col-form-label-sm">Tipo de usuario</label>
                                            <div class="col-sm-12 px-0">
                                                <select class="form-control form-control-sm text-gray-900" name="InputTipoUsuario" id="InputTipoUsuario" required> <!--Enlista los tipos de usuarios disponibles -->
                                                    <option value="" selected hidden>Seleccione su tipo de usuario</option>
                                                    <option value="Administrador">Administrador</option>
                                                    <option value="Profesor">Profesor</option>
                                                    <option value="Alumno">Alumno</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="InputEstadoUsuario" class="col-form-label col-form-label-sm">Estado del usuario</label>
                                            <div class="col-sm-12 px-0">
                                                <select class="form-control form-control-sm text-gray-900" name="InputEstadoUsuario" id="InputEstadoUsuario" required> <!--Enlista los estados de usuario -->
                                                    <option value="" selected hidden>Seleccione el estado del usuario</option>
                                                    <option value="0">Inactivo</option>
                                                    <option value="1">Activo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="InputNombre" class="col-sm-3 col-form-label col-form-label-sm">Nombre</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" id="InputIdUsuario" name="InputIdUsuario">
                                            <input type="text" class="form-control form-control-sm text-gray-900" id="InputNombre" name="InputNombre" placeholder="Nombre/s" disabled="true">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="InputNombre" class="col-sm-3 col-form-label col-form-label-sm">Apellido paterno</label>
                                        <div class="col-sm-9">
                                            <input id="InputApellidoPaterno" name="InputApellidoPaterno" class="form-control form-control-sm text-gray-900" type="text" placeholder="Apellido paterno" disabled="true">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="InputNombre" class="col-sm-3 col-form-label col-form-label-sm">Apellido materno</label>
                                        <div class="col-sm-9">
                                            <input id="InputApellidoMaterno" name="InputApellidoMaterno" class="form-control form-control-sm text-gray-900" type="text" placeholder="Apellido materno" disabled="true">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6" id="ContenedorSemestre">
                                            <label for="InputNombre" class="col-form-label col-form-label-sm">Semestre</label>
                                            <div class="col-sm-12">
                                                <select name="InputSemestre" id="InputSemestre" class="form-control form-control-sm text-gray-900">
                                                    <option value="" class="OpcionGenerica" selected hidden>Seleccione su semestre</option>
                                                    <option value="1">Primero</option>
                                                    <option value="2">Segundo</option>
                                                    <option value="3">Tercero</option>
                                                    <option value="4">cuarto</option>
                                                    <option value="5">Quinto</option>
                                                    <option value="6">Sexto</option>
                                                    <option value="7">Septimo</option>
                                                    <option value="8">Octavo</option>
                                                    <option value="9">Noveno</option>
                                                    <option value="10">Decimo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6" id="ContenedorNoCuenta">
                                            <label for="InputNombre" class="col-form-label col-form-label-sm">No.Cuenta</label>
                                            <div class="col-sm-12 px-0">
                                                <input id="InputNoCuenta" name="InputNoCuenta" class="form-control form-control-sm text-gray-900" type="text" placeholder="Numero de cuenta" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3" id="ContenedorDependencia">
                                        <label for="InputNombre" class="col-sm-3 col-form-label col-form-label-sm">Espacio academico</label>
                                        <div class="col-sm-9">
                                            <select name="InputDependencia" id="InputDependencia" class="form-control form-control-sm text-gray-900">
                                                <option value="" selected hidden>Seleccione su espacio academico</option>
                                                <option value="1">Facultad de ingenieria</option>
                                                <option value="2">Facultad de arquitectura</option>
                                                <option value="3">facultad de artes</option>
                                                <option value="0">Externo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3" id="ContenedorLicenciatura">
                                        <label for="InputNombre" class="col-sm-3 col-form-label col-form-label-sm">Licenciatura</label>
                                        <div class="col-sm-9">
                                            <select name="InputLicenciatura" id="InputLicenciatura" class="form-control form-control-sm text-gray-900">
                                                <option value="" selected hidden>Seleccione su licenciatura</option>
                                                <option value="1">ICO</option>
                                                <option value="2">ICI</option>
                                                <option value="3">ISES</option>
                                                <option value="4">IME</option>
                                                <option value="5">IEL</option>
                                                <option value="6">Diseño industrial</option>
                                                <option value="7">Arquitectura</option>
                                                <option value="8">APOU</option>
                                                <option value="9">Artes plasticas</option>
                                                <option value="10">Artes digitales</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="InputNombre" class="col-sm-3 col-form-label col-form-label-sm">Correo Institucional</label>
                                        <div class="col-sm-9">
                                            <input id="InputCorreoInstitucional" name="InputCorreoInstitucional" class="form-control form-control-sm text-gray-900" type="text" placeholder="Correo Institucional" disabled="true">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="InputNombre" class="col-sm-3 col-form-label col-form-label-sm">Correo personal</label>
                                        <div class="col-sm-9">
                                            <input id="InputCorreoPersonal" name="InputCorreoPersonal" class="form-control form-control-sm text-gray-900" type="text" placeholder="Correo Personal" disabled="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-mb-4 col-lg-3">
                            <p>Persmisos</p>
                            <div id="frmPermiso"></div>
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