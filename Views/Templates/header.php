<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Panel de Administración</title>
        <link href="<?php echo base_url;?>Assets/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url;?>Assets/DataTables/datatables.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="<?php echo base_url;?>Assets/css/select2.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url;?>Assets/css/estilos.css" rel="stylesheet"/>
        <script src="<?php echo base_url;?>Assets/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?php echo base_url; ?>Administracion/home">Gestor Comercial</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cambiar_pass">Mi Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-cogs text-primary"></i></div>
                                Administración
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-primary"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Usuarios"><i class="fas fa-user m-2"></i> Usuarios</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Administracion"><i class="fas fa-tools m-2"></i> Configuración</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCaja" aria-expanded="false" aria-controls="collapseCaja">
                                <div class="sb-nav-link-icon"><i class="fas fa-box text-primary"></i></div>
                                Cajas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-primary"></i></div>
                            </a>
                            <div class="collapse" id="collapseCaja" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Cajas"><i class="fas fa-box m-2"></i> Cajas</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Cajas/indexArqueoCaja"><i class="fas fa-tools m-2"></i> Arqueo Caja</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="<?php echo base_url; ?>Clientes" >
                                <div class="sb-nav-link-icon"><i class="fas fa-users text-primary"></i></div>
                                Clientes
                            </a>
                            <a class="nav-link collapsed" href="<?php echo base_url; ?>Medidas" >
                                <div class="sb-nav-link-icon"><i class="fas fa-balance-scale text-primary"></i></div>
                                Medidas
                            </a>
                            <a class="nav-link collapsed" href="<?php echo base_url; ?>Categorias" >
                                <div class="sb-nav-link-icon"><i class="fas fa-users text-primary"></i></div>
                                Categorias
                            </a>
                            <a class="nav-link collapsed" href="<?php echo base_url; ?>Productos" >
                                <div class="sb-nav-link-icon"><i class="fab fa-product-hunt text-primary"></i></div>
                                Productos
                            </a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart mr-2 text-primary"></i></div>
                                Entradas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-primary"></i></div>
                            </a>
                            <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Compras"><i class="fas fa-shopping-cart mr-2"></i>Nueva Compra</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Compras/historial"><i class="fas fa-list mr-2"></i>Historial Compras</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVentas" aria-expanded="false" aria-controls="collapseVentas">
                                <div class="sb-nav-link-icon"><i class="fas fa-cash-register mr-2 text-primary"></i></div>
                                Salidas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-primary"></i></div>
                            </a>
                            <div class="collapse" id="collapseVentas" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Ventas"><i class="fas fa-shopping-cart mr-2"></i>Nueva Venta</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Ventas/historial_ventas"><i class="fas fa-list mr-2"></i>Historial Ventas</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid mt-2">
                    