<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php
    $url = $_SERVER["REQUEST_URI"];
    $Componentes = parse_url($url);
    parse_str($Componentes['query'], $resultados);
    if (empty($resultados)) {
        $resultados["pagina"] = "Inicio";
    }
    ?>
    <title><?php print_r($resultados["pagina"]) ?> | SIPRETAM</title>

    <link rel="icon" type="image/jpg" href="/assets/img/icono.png" />

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo '../../assets/'; ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo '../../assets/'; ?>css/snackbar.min.css" rel="stylesheet">
    <link href="<?php echo '../../assets/'; ?>css/iframe.css" rel="stylesheet">
    <link href="<?php echo '../../assets/'; ?>css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo '../../assets/'; ?>css/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo '../../assets/'; ?>css/dataTables.dateTime.min.css" />

</head>
<?php $mini = false;
if (!empty($_GET['pagina'])) {
    if ($_GET['pagina'] == 'ventas' || $_GET['pagina'] == 'compras') {
        $mini = true;
    }
}
?>

<body id="page-top" class="<?php echo ($mini) ? 'sidebar-toggled' : ''; ?>">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion toggled     <?php echo ($mini) ? 'toggled' : ''; ?>" id="accordionSidebar" style="background-color:#005432;">
            <div class="text-center d-none d-md-inline mt-3">
                <button class="btn p-2" id="sidebarToggle"><i class="fa fa-bars text-light fa-lg" id="IconoMenu"></i></button>
            </div>
            <!-- Divider -->

            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo (empty($_GET['pagina'])) ? 'bg-ligth-background' : ''; ?>">
                <a class="nav-link" href="plantilla.php">
                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item <?php echo (!empty($_GET['pagina'])  && $_GET['pagina'] == 'calendario') ? 'bg-ligth-background' : ''; ?>">
                <a class="nav-link" href="?pagina=calendario">
                    <i class="fas fa-calendar"></i>
                    <span>Calendario</span></a>
            </li>


            <?php if (!empty($usuarios)) { ?>
                <li class="nav-item <?php echo (!empty($_GET['pagina'])  && $_GET['pagina'] == 'usuarios') ? 'bg-ligth-background' : ''; ?>">
                    <a class="nav-link" href="?pagina=usuarios">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Usuarios</span>
                    </a>
                </li>
            <?php } ?>

            <?php if (!empty($prestamos) || !empty($nuevo_prestamo)) { ?>
                <li class="nav-item <?php echo (!empty($_GET['pagina'])  && $_GET['pagina'] == 'Prestamos' || !empty($_GET['pagina'])  && $_GET['pagina'] == 'Historial') ? 'bg-ligth-background' : ''; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompra" aria-expanded="true" aria-controls="collapseCompra">
                        <i class="fas fa-fw fa-calendar-plus"></i>
                        <span>Prestamos</span>
                    </a>
                    <div id="collapseCompra" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-success py-2 collapse-inner rounded">
                            <?php
                            if (!empty($nuevo_prestamo)) { ?>
                                <a class="collapse-item text-white" href="?pagina=NuevaSolicitud">Nueva solicitud</a>
                            <?php }
                            if (!empty($compras)) { ?>
                                <a class="collapse-item text-white" href="?pagina=Prestamos">Historial</a>
                            <?php }?>
                        </div>
                    </div>
                </li>
            <?php } ?>
            <?php if (!empty($maquinas)) { ?>
                <!-- Nav Item - Maquinas -->
                <li class="nav-item <?php echo (!empty($_GET['pagina'])  && $_GET['pagina'] == 'maquinas') ? 'bg-ligth-background' : ''; ?>">
                    <a class="nav-link" href="?pagina=maquinas">
                        <i class="fas fa-fw fa-cash-register"></i>
                        <span>Maquinas</span></a>
                </li>
            <?php } ?>
            <?php if (!empty($herramientas)) { ?>
                <!-- Nav Item - Herramientas -->
                <li class="nav-item <?php echo (!empty($_GET['pagina'])  && $_GET['pagina'] == 'herramientas') ? 'bg-ligth-background' : ''; ?>">
                    <a class="nav-link" href="?pagina=herramientas">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Herramientas</span></a>
                </li>
            <?php } ?>
            <?php if (!empty($materias)) { ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item <?php echo (!empty($_GET['pagina'])  && $_GET['pagina'] == 'materias') ? 'bg-ligth-background' : ''; ?>">
                    <a class="nav-link" href="?pagina=materias">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Materias</span>
                    </a>
                </li>
            <?php } ?>

            <?php if (!empty($clientes)) { ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <!--<li class="nav-item <?php echo (!empty($_GET['pagina'])  && $_GET['pagina'] == 'clientes') ? 'bg-ligth-background' : ''; ?>">
                    <a class="nav-link" href="?pagina=clientes">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Clientes</span>
                    </a>
                </li>
            <?php } ?>

            <?php if (!empty($proveedor)) { ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <!--<li class="nav-item <?php echo (!empty($_GET['pagina'])  && $_GET['pagina'] == 'proveedor') ? 'bg-ligth-background' : ''; ?>">
                    <a class="nav-link" href="?pagina=proveedor">
                        <i class="fas fa-store"></i>
                        <span>Proveedores</span>
                    </a>
                </li>
            <?php } ?>

            <?php if (!empty($productos)) { ?>
                <!--
                <li class="nav-item <?php echo (!empty($_GET['pagina'])  && $_GET['pagina'] == 'productos') ? 'bg-ligth-background' : ''; ?>">
                    <a class="nav-link" href="?pagina=productos">
                        <i class="fas fa-fw fa-list"></i>
                        <span>Productos</span>
                    </a>
                </li>-->
            <?php } ?>

            <?php if (!empty($nueva_compra) || !empty($compras)) { ?>
                <!--<li class="nav-item <?php echo (!empty($_GET['pagina'])  && $_GET['pagina'] == 'compras' || !empty($_GET['pagina'])  && $_GET['pagina'] == 'historial_compras') ? 'bg-ligth-background' : ''; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompra" aria-expanded="true" aria-controls="collapseCompra">
                        <i class="fas fa-cart-plus"></i>
                        <span>Compras</span>
                        <i class="fas fa-chevron-right float-right"></i>
                    </a>
                    <div id="collapseCompra" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php
                            if (!empty($nueva_compra)) { ?>
                                <a class="collapse-item" href="?pagina=compras">Nueva compra</a>
                            <?php }
                            if (!empty($compras)) { ?>
                                <a class="collapse-item" href="?pagina=historial_compras">Lista compras</a>
                            <?php } ?>
                        </div>
                    </div>
                </li>-->
            <?php } ?>

            <?php if (!empty($nueva_venta) || !empty($ventas)) { ?>
             <!--   <li class="nav-item <?php echo (!empty($_GET['pagina'])  && $_GET['pagina'] == 'ventas' || !empty($_GET['pagina'])  && $_GET['pagina'] == 'historial') ? 'bg-success' : ''; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVenta" aria-expanded="true" aria-controls="collapseVenta">
                        <i class="fas fa-cash-register"></i>
                        <span>Ventas</span>
                        <i class="fas fa-chevron-right float-right"></i>
                    </a>
                    <div id="collapseVenta" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php
                            if (!empty($nueva_venta)) { ?>
                                <a class="collapse-item" href="?pagina=ventas">Nueva venta</a>
                            <?php }
                            if (!empty($ventas)) { ?>
                                <a class="collapse-item" href="?pagina=historial">Lista ventas</a>
                            <?php } ?>
                        </div>
                    </div>
                </li>-->
            <?php } ?>

            <?php if (!empty($configuracion)) { ?>

                <li class="nav-item <?php echo (!empty($_GET['pagina']) && $_GET['pagina'] == 'configuracion') ? 'bg-ligth-background' : ''; ?>">
                    <a class="nav-link" href="?pagina=configuracion">
                        <i class="fas fa-cog"></i>
                        <span>Configuración</span>
                    </a>
                </li>
            <?php } ?>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-3 static-top shadow" style="background-color:#17223d;">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto" style="width: 100%;">
                        <li class="nav-item">
                            <a class="nav-link" href="www.uaemex.mx" id="UaemexLogotipo">
                                <!--<img src="../../Assets/img/UAEMEX-logoV2.webp" alt="" style="height:50px;">-->
                                <div class="sidebar-brand-icon ">
                                    <img src="../../assets/img/icono.png" alt="SIPRETAM Logo" class="brand-image img-circle" style="width:30px;">
                                </div>
                                <div class="sidebar-brand-text mx-3 text-gray-100">
                                    <b>SIPRETAM | UAEMex</b>
                                </div>
                            </a>
                        </li>
                        <div class="topbar-divider d-none d-sm-block ml-auto"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-question-circle text-gray-100" title="Ayuda"></i>
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="?pagina=general">
                                    Ayuda general
                                </a>
                                <!--<a class="dropdown-item" href="?pagina=general">
                                    Prefuntas frecuentes
                                </a>
                                <a class="dropdown-item" href="?pagina=acercade">
                                    Acerca de
                                </a>-->
                            </div>
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-100 small" id="NombreUsuario"><?php echo $_SESSION['nombre']?></span>
                                <span class="mr-2 d-none d-lg-inline text-gray-100 small" id="NoCuenta"><?php echo $_SESSION['NoCuenta']?></span>
                                <!--<img class="img-profile rounded-circle" src="../../assets/img/user_profile.png">-->
                                <div id="ContenedorAvatarHeader">

                                </div>
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="?pagina=Perfil&Usuario=<?php echo $_SESSION['idusuario']; ?>">
                                        <!--<img class="img-profile rounded-circle " style="width:80px;" src="<?php echo '../../assets/img/user_profile.png'; ?>">-->
                                        <div id="ContenedorAvatarDropdown"></div>
                                        <span class="mr-2 d-inline"><b>Mi perfil</b></span>
                                    </a>
                                </div>
                                <a class="dropdown-item" href="?pagina=Prestamos">
                                    <i class="fas fa-calendar fa-sm fa-fw mr-2 text-gray-800"></i>
                                    Mis prestamos
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-800"></i>
                                    Cerrar sesion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">