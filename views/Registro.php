<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIPRETAM | Registro</title>
    <link rel="icon" href="../assets/img/icono.png" sizes="16x16" type="image/png">

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/all.min.js" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- SweetAlert2 js-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-4">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!--<div class="col-lg-3 d-none d-lg-block bg-register-image"></div>-->
                    <div class="col-lg-12">
                        <div class="p-3">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-2">Crear una cuenta</h1>
                            </div>
                            <form class="user" id="FormularioRegistroUsuario" autocomplete="off">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <select class="form-control form-control-sm text-gray-900" name="InputTipoUsuario" id="InputTipoUsuario" required> <!--Enlista los tipos de usuarios disponibles -->
                                            <option value="" selected hidden>Seleccione su tipo de usuario</option>
                                            <option value="2">Profesor</option>
                                            <option value="3">Alumno</option>
                                        </select>
                                    </div>
                                    <div class="position-relative mb-3">

                                        <input class="form-control form-control-sm text-gray-900" type="text" id="InputNombre" placeholder="Nombre/s" name="InputNombre" required>
                                    </div>
                                    <div class="position-relative mb-3">

                                        <input class="form-control form-control-sm text-gray-900" type="text" id="InputApellidoPaterno" placeholder="Apellido paterno" name="InputApellidoPaterno" required>
                                    </div>
                                    <div class="position-relative mb-3">

                                        <input class="form-control form-control-sm text-gray-900" type="text" id="InputApellidoMaterno" placeholder="Apellido materno" name="InputApellidoMaterno" required>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input class="InputNoCuenta form-control form-control-sm text-gray-900" id="InputNoCuenta" type="text" placeholder="No. cuenta" name="InputNoCuenta" required>
                                        </div>
                                        <div class="form-group col-md-6" id="ContenedorSemestre">

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
                                    <div class="position-relative mb-3">
                                        <input class="form-control form-control-sm text-gray-900" type="text" id="InputCorreo" placeholder="Correo Institucional - ejemplo000@alumno.uaemex.mx" name="InputCorreo" required>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6" id="ContenedorDependencia">
                                            <select name="InputDependencia" id="InputDependencia" class="form-control form-control-sm text-gray-900">
                                                <option value="" selected hidden>Seleccione su espacio academico</option>
                                                <option value="1">Facultad de ingenieria</option>
                                                <option value="2">Facultad de arquitectura</option>
                                                <option value="3">facultad de artes</option>
                                                <option value="0">Externo</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6" id="ContenedorLicenciatura">
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
                                </div>
                                <!--<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#ModalAviso">-->
                                <button id="BtnRegistroUsuario" type="button" class="btn btn-primary btn-block">
                                    Enviar solcitud de registro
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="/">¡Ya tienes una cuenta?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="ModalAviso" aria-labelledby="ModalAviso" aria-hidden="true" data-backdrop="static" data-keyboard="false">

        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5">!Antes de realizar tu registro recueda que..!</h2>
                </div>
                <div class="modal-body">

                </div>
                <div class="px-4">
                    <!--<img src="../../imagenes/TimeOut.svg" style="width:50%; margin:auto;">-->
                    <p><b>Los datos registrados deben de ser veridicos y coincidir con los mostrados en tu crendecial institucional.</b></p>
                    <p>Ingresar datos falsos podria ser motivo de una penalizacion en el uso del sistema y los instrumentos del taller de manufactura.</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-dismiss="modal" id="BtnRegistroModal">Realizar registro</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <img src="../assets/img/FRENTE2.jpg" style="width:100%;">
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del Modal -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto text-white">
                <span>Copyright &copy; SIPRETAM | Universidad Autonoma del Estado de Mexico <?php echo date('Y'); ?></span>
            </div>
            <br>
            <br>
            <div class="row copyright text-center my-auto text-white">
                <div class="col-lg-6 text-center">
                    <h5>VINCULOS</h5>
                    <hr>
                    <ul class="text-center p-0" style="list-style-type: none;">
                        <li>
                            <span>
                                <a class="text-decoration-none text-white" href="https://www.uaemex.mx/"><i class="fas fa-university"></i> UAEMéx</a><br>
                                <br>
                            </span>
                        </li>
                        <li>
                            <span>
                                <a class="text-decoration-none text-white" href="https://fi.uaemex.mx/portal/inicio/home.php"> <i class="fas fa-graduation-cap"></i> Facultad de Ingeniería UAEMéx</a><br>
                                <br>
                            </span>
                        </li>

                    </ul>
                </div>
                <div class="col-lg-6 text-center">
                    <h5>CONTACTO</h5>
                    <hr>
                    <ul class="text-center p-0" style="list-style-type: none;">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>
                                Facultad de Ingeniería UAEM<br>
                                Cerro de Coatepec S/N<br>
                                Ciudad Universitaria C.P. 50100.<br>
                                Toluca, Estado de México
                            </span>

                        </li>
                        <br>
                        <li>
                            <i class="fas fa-fw fa-phone"></i>
                            <span>
                                Tels.:(722) 111 22 33 y 444 55 66<br>
                                Ext: 1234
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>
    <!-- SweetAlert2 js-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- fontawesome -->
    <script src="/assets/vendor/fontawesome-free/all.min.js"></script>

    <!-- Usuarios script -->
    <script src="/assets/js/Registro.js"></script>
    <!-- Axios-->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>

</html>