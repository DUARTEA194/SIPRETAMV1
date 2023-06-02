</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto text-gray-900">
            <span>Copyright &copy; SIPRETAM | Universidad Autonoma del Estado de Mexico <?php echo date('Y'); ?></span>
        </div>
        <!--<br>
        <br>
        <div class="row copyright text-center my-auto text-gray-900">
            <div class="col-lg-6 text-center">
                <h5>VINCULOS</h5>
                <hr>
                <ul class="text-center p-0" style="list-style-type: none;">
                    <li>
                        <span>
                            <a class="text-decoration-none text-gray-900" href="https://www.uaemex.mx/"><i class="fas fa-university"></i> UAEMéx</a><br>
                            <br>
                        </span>
                    </li>
                    <li>
                        <span>
                            <a class="text-decoration-none text-gray-900" href="https://fi.uaemex.mx/portal/inicio/home.php"> <i class="fas fa-graduation-cap"></i> Facultad de Ingeniería UAEMéx</a><br>
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
        </div>-->
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Esta seguro de salir?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo '../../controllers/ventasController.php?option=logout'; ?>">Salir</a>
            </div>
        </div>
    </div>
</div>
<!-- Fin Logout Modal-->

<!-- Reporte Modal-->
<div class="modal fade" id="OpcionesReporte" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Seleccione un formato de archivo</h5>
                <button class="close" id="ButtonClose" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-danger"><i class="fas fa-fw fa-file-pdf"></i>PDF</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-success"><i class="fas fa-fw fa-file-csv"></i>EXCEL</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary"><i class="fas fa-fw fa-print"></i>Imprimir</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- Reporte Modal-->

<!-- Bootstrap core JavaScript-->
<script src="<?php echo '../../assets/'; ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo '../../assets/'; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo '../../assets/'; ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo '../../assets/'; ?>js/sb-admin-2.min.js"></script>

<script src="<?php echo '../../assets/'; ?>js/chart.js"></script>
<!-- Page level custom scripts -->
<script src="<?php echo '../../assets/'; ?>vendor/fontawesome-free/all.min.js"></script>
<script src="<?php echo '../../assets/'; ?>js/snackbar.min.js"></script>
<script src="<?php echo '../../assets/'; ?>js/axios.min.js"></script>

<script type="text/javascript" src="<?php echo '../../assets/'; ?>js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo '../../assets/'; ?>js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo '../../assets/'; ?>js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="<?php echo '../../assets/'; ?>js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo '../../assets/'; ?>js/buttons.html5.min.js"></script> 
<script type="text/javascript" src="<?php echo '../../assets/'; ?>js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo '../../assets/js/jszip.min.js'?>" ></script>
<script type="text/javascript" src="<?php echo '../../assets/js/pdfmake.min.js'?>"></script>
<script type="text/javascript" src="<?php echo '../../assets/js/vfs_fonts.js'?>"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
<!--Importacion del plugin fullcalendar -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.5/index.global.min.js'></script>
<!-- SweetAlert2 js-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--CSV READER library-->
<script src="/assets/vendor/jquery-csv-main/src/jquery.csv.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        SetearUsuarioFooter();
    });

    function SetearUsuarioFooter() {
        Nombre = $("#NombreUsuario").text();
        GenerarAvatarFooter(Nombre);
    }

    function GenerarAvatarFooter(Nombre) {
        var Iniciales = Nombre[0];
        Iniciales = Iniciales.toUpperCase();
        var Avatar = $("<span>", {
            class: "avatar avatar-sm rounded-circle bg-success",
            text: Iniciales,
            css: {
                display: "flex",
                color: "white",
                fontSize: "12px",
                fontWeight: "bold",
                width: "32px",
                height: "32px",
                alignItems: "center",
                margin: "auto",
                justifyContent: "center",
            }
        });
        $("#ContenedorAvatarHeader").append(Avatar.clone());
        $("#ContenedorAvatarDropdown").append(Avatar.clone());
    }

    //Muestra un mensaje al usuario
    function Mensaje(Tipo, Mensaje) {
        Swal.fire("", Mensaje, Tipo);
    }

    function message(tipo, mensaje) {
        Snackbar.show({
            text: mensaje,
            pos: 'top-right',
            backgroundColor: tipo == 'success' ? '#079F00' : '#FF0303',
            actionText: 'Cerrar'
        });
    }

    function verificarEstadoCuenta() {
        var SpanNoCuenta = document.getElementById("NoCuenta");
        var NoCuenta = SpanNoCuenta.innerText;
        //console.log(NoCuenta);
        $.ajax({
            url: '/controllers/usuariosController.php?option=VerifcarEstadoCuenta&NoCuenta=' + NoCuenta, // Ruta del archivo PHP que verifica el estado de la cuenta
            method: 'GET',
            success: function(response) {

                if (response === '0') {
                    //Mensaje('error', 'Tu cuenta ha sido desactivada. Serás redirigido al inicio de sesión.');
                    let timerInterval
                    Swal.fire({
                        icon: 'error',
                        title: 'Su cuenta ha sido desactivada',
                        html: 'Serás redirigido al login en: <b></b> millisegundos.',
                        timer: 5000,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                           window.location.href = '/controllers/ventasController.php?option=logout'
                        }
                    })
                    ;
                }
                //console.log(response);
            }
        });
    }
    setInterval(verificarEstadoCuenta, 5000); // Consulta cada 5 segundos (por ejemplo)
</script>
<?php
if (!empty($_GET['pagina'])) {
    $script = $_GET['pagina'] . '.js';
    if (file_exists('assets/js/' . $script)) {
        echo '<script src="../../assets/js/' . $script . '"></script>';
    }
} else {
    echo '<script src="../../assets/js/index.js"></script>';
} ?>

</body>

</html>