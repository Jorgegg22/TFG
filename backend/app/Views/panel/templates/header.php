<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Univibe | Admin</title>

    <link href="<?= base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
     <link href="<?= base_url('css/gestion.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/index.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="<?= base_url('vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('vendor/jquery/jquery-3.7.1.js') ?>"></script>
    <script src="<?= base_url('vendor/js/miJs.js') ?>"></script>
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0056b3;">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/') ?>">
              
                <div class="sidebar-brand-text mx-3">UniVibe Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Resumen General</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Gestión Inmobiliaria</div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/inmuebles') ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Inmuebles</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/solicitudes') ?>">
                    <i class="fas fa-fw fa-file-signature"></i>
                    <span>Solicitudes</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/matches') ?>">
                    <i class="fas fa-fw fa-handshake"></i>
                    <span>Matches</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Comunidad</div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/usuarios') ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Usuarios</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Configuración</div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/universidades') ?>">
                    <i class="fa-solid fa-building-columns" ></i>
                    <span>Universidades</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/carreras') ?>">
                    <i class="fas fa-fw fa-graduation-cap" ></i>
                    <span>Carreras</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/atributos') ?>">
                    <i class="fas fa-fw fa-tags" ></i>
                    <span>Atributos</span>
                </a>
            </li>
            
        

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
               <a href="<?= base_url("api/auth/logout")?>" class="btn btn-danger">Cerrar Sesión</a>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <ul class="navbar-nav ml-auto align-items-center">

                        <li class="nav-item mx-1">
                            <button class="btn btn-sm btn-primary shadow-sm px-3" onclick="location.reload()"
                                style="border-radius: 10px; font-weight: 600;">
                                <i class="fas fa-sync-alt fa-sm text-white-50 mr-1"></i> Actualizar
                            </button>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
                                <img class="img-profile rounded-circle"
                                    src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg"
                                    alt="Perfil">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>