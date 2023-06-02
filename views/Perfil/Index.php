<form id="FormularioDatosUsuario">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Mi perfil</h1>
        <div>
            <button type="button" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm d-none" data-toggle="modal" data-target="#ModalAviso" id="BtnEdiatarPerfil"><i class="fas fa-fw fa-pen mx-1"></i><Span>Editar</Span></button>
            <button type="button" class="btn btn-sm btn-danger shadow-sm d-none" id="BtnCancelarPerfil" onclick="CancelarEdicion()"><i class="fas fa-fw fa-window-close mx-1"></i><Span>Cancelar</Span></button>
            <button type="button" class="btn btn-sm btn-success shadow-sm d-none" id="BtnGuardarPerfil"><i class="fas fa-fw fa-save mx-1"></i><Span>Guardar</Span></button>
        </div>
    </div>

    <div class="row p-2 mb-5">
        <div class="col-12 col-sm-12 col-mb-6 col-lg-5">
            <div class="card border">
                <div class="card-body">
                    <div id="ContenedorAvatarPerfil" class="row text-center mb-5">
                        <!--<img class="img-profile rounded-circle mx-auto" src="../Assets/img/user_profile.png" style="height: 200px;">-->
                    </div>
                    <div class="row mb-3">
                        <label for="InputNombre" class="col-sm-4 col-form-label col-form-label-sm">Nombre</label>
                        <div class="col-sm-8">
                            <input type="hidden" id="InputEstadoUsuario" name="InputEstadoUsuario">
                            <input type="hidden" id="InputIdUsuario" name="InputIdUsuario">
                            <input type="text" class="form-control form-control-sm" id="InputNombre" name="InputNombre" placeholder="Nombre/s" disabled="true">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="InputNombre" class="col-sm-4 col-form-label col-form-label-sm">Apellido paterno</label>
                        <div class="col-sm-8">
                            <input id="InputApellidoPaterno" name="InputApellidoPaterno" class="form-control form-control-sm" type="text" placeholder="Apellido paterno" disabled="true">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="InputNombre" class="col-sm-4 col-form-label col-form-label-sm">Apellido materno</label>
                        <div class="col-sm-8">
                            <input id="InputApellidoMaterno" name="InputApellidoMaterno" class="form-control form-control-sm" type="text" placeholder="Apellido materno" disabled="true">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-mb-6 col-lg-7">
            <div class="card border">
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="InputUsuario" class="col-sm-3 col-form-label col-form-label-sm">Tipo de usuario</label>
                        <div class="col-sm-9">
                            <!--<input id="InputTipoUsuario" name="InputTipoUsuario" class="form-control form-control-sm" type="text" placeholder="Numero telefonico" disabled="true">-->
                            <span class="badge bg-primary text-white" for="InputUsuario" id="InputTipoUsuario" name="InputTipoUsuario"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="InputNombre" class="col-sm-3 col-form-label col-form-label-sm">No.Cuenta</label>
                        <div class="col-sm-9">
                            <input id="InputNoCuenta" name="InputNoCuenta" class="form-control form-control-sm" type="text" placeholder="Numero de cuenta" disabled="true">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="InputNombre" class="col-sm-3 col-form-label col-form-label-sm">Espacio academico</label>
                        <div class="col-sm-9">
                            <select name="InputDependencia" id="InputDependencia" class="form-control form-control-sm text-gray-900" disabled>
                                <option value="" selected hidden>Seleccione su espacio academico</option>
                                <option value="1">Facultad de ingenieria</option>
                                <option value="2">Facultad de arquitectura</option>
                                <option value="3">facultad de artes</option>
                                <option value="0">Externo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="InputNombre" class="col-sm-3 col-form-label col-form-label-sm">Licenciatura</label>
                        <div class="col-sm-9">
                            <select name="InputLicenciatura" id="InputLicenciatura" class="form-control form-control-sm text-gray-900" disabled>
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
                            <input id="InputCorreoInstitucional" name="InputCorreoInstitucional" class="form-control form-control-sm" type="text" placeholder="Correo Institucional" disabled="true">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="InputNombre" class="col-sm-3 col-form-label col-form-label-sm">Correo personal</label>
                        <div class="col-sm-9">
                            <input id="InputCorreoPersonal" name="InputCorreoPersonal" class="form-control form-control-sm" type="text" placeholder="Correo Personal" disabled="true">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="InputNombre" class="col-sm-3 col-form-label col-form-label-sm">Semestre</label>
                        <div class="col-sm-9">
                            <select name="InputSemestre" id="InputSemestre" class="form-control form-control-sm text-gray-900" disabled>
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

                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="ModalAviso" aria-labelledby="ModalAviso" aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-dialog-centered modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">!Antes de editar los datos recueda que..!</h1>
            </div>
            <div class="modal-body">

            </div>
            <div class="px-4">
                <!--<img src="../../imagenes/TimeOut.svg" style="width:50%; margin:auto;">-->
                <p><b>Los datos registrados deben de ser veridicos y coincidir con los mostrados en tu crendecial institucional.</b></p>
                <p>Ingresar datos falsos podria ser motivo de una penalizacion en el uso del sistema y los instrumentos del taller de manufactura.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="HabilitarInputs()">Si, estoy seguro</button>
                <img src="/assets/img/FRENTE2.jpg" style="width:100%;">
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->