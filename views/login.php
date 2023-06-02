<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIPRETAM | Login</title>

    <link rel="icon" type="image/jpg" href="/assets/img/icono.png"/>

    <!-- Custom fonts for this template-->
    <!--<link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- SweetAlert2 js-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="px-5 py-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Inicia sesion</h1>
                                    </div>
                                    <form class="user" autocomplete="off" id="FrmLogin">
                                        <div class="form-group">
                                            <label for="CorreoInstitucional">Correo institucional <span class="text-danger">*</span></label>
                                            <input type="CorreoInstitucional" class="form-control" id="CorreoInstitucional" aria-describedby="emailHelp" placeholder="Correo institucional" name="CorreoInstitucional">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Contraseña<span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="Password" placeholder="contraseña" name="Password">
                                        </div>
                                        <div class="form-group text-center">
                                            <img src="/assets/img/captcha.png" alt="" style="max-width: 90%;">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            ingresar
                                        </button>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a href="?pagina=Registro">¿No tienes una cuenta?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
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
    
    <!-- fontawesome -->
    <script src="../../assets/vendor/fontawesome-free/all.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>
    <script src="/assets/js/snackbar.min.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <script src="/assets/js/Login.js"></script>
</body>


</html>