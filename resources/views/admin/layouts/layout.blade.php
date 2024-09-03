<?php
    use App\Models\Utils;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main-admin.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://use.fontawesome.com/97a88bff0a.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script type="text/javascript">
        window.CSRF_TOKEN = '{{ csrf_token() }}';
    </script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <div class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon c-pointer" onclick="menuHome()">
                    <img class="invert-color-logo" src="/img/logos/logo-marcshuttle-black.png" alt="Logo Marcshuttle" style="width:100px;">
                </div>
            </div>
            <!-- Divider -->
            <!-- Nav Item - Dashboard -->
            <!-- <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li> -->
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Interface
            </div> -->
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-desktop" aria-hidden="true"></i>
                    <span>Administración</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Shuttle:</h6>
                        @if(Utils::validPermision(request()->session()->get('permisos'), config('ListPermision.VISUALIZAR_ZONAS')))
                            <a class="collapse-item c-pointer" onclick="menuZonas()">Zonas</a>
                        @endif
                        @if(Utils::validPermision(request()->session()->get('permisos'), config('ListPermision.VISUALIZAR_LOCACIONES')))
                            <a class="collapse-item c-pointer" onclick="menuLocations()">Hotel / Airbnb</a>
                        @endif
                        <h6 class="collapse-header">Tours:</h6>
                        @if(Utils::validPermision(request()->session()->get('permisos'), config('ListPermision.VISUALIZAR_VEHICULOS')))
                            <a class="collapse-item c-pointer" onclick="menuVehicles()">Vehiculos</a>
                        @endif
                        @if(Utils::validPermision(request()->session()->get('permisos'), config('ListPermision.VISUALIZAR_TOURS')))
                            <a class="collapse-item c-pointer" onclick="menuTours()">Tour</a>
                        @endif
                        @if(Utils::validPermision(request()->session()->get('permisos'), config('ListPermision.AGREGAR_PERMISOS')))
                            <h6 class="collapse-header">Promociones:</h6>
                            <a class="collapse-item c-pointer" onclick="menuCupones()">Cupones</a>
                        @endif
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Configuración</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Folio</a>
                        <a class="collapse-item" href="#">Email notificacion</a>
                    </div>
                </div>
            </li> -->
                        <!-- Heading -->
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports"
                    aria-expanded="true" aria-controls="collapseReports">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Reportes</span>
                </a>
                <div id="collapseReports" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if(Utils::validPermision(request()->session()->get('permisos'), config('ListPermision.VISUALIZAR_REPORTE_TRIP')))
                            <a class="collapse-item c-pointer" onclick="menuBookingsTripReport()">Bookings Trip</a>
                        @endif
                        @if(Utils::validPermision(request()->session()->get('permisos'), config('ListPermision.VISUALIZAR_REPORTE_TOUR')))
                            <a class="collapse-item c-pointer" onclick="menuBookingsTourReport()">Bookings Tours</a>
                        @endif
                    </div>
                </div>
            </li>

                @if(Utils::validPermision(request()->session()->get('permisos'), config('ListPermision.VISUALIZAR_USUARIOS')))
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                            aria-expanded="true" aria-controls="collapseUsers">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Usuarios</span>
                        </a>
                        <div id="collapseUsers" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item c-pointer" onclick="menuUser()">Usuarios</a>
                            </div>
                        </div>
                    </li>
                @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div>
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Search -->
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="panel-name-user">{{request()->session()->get('name_user')}}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" onclick="showDataModalUser()">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Datos usuario
                                </a>
                                <a class="dropdown-item" href="#" onclick="openChangePasswordModal()">
                                    <i class="fa fa-key mr-2 text-gray-400"></i>
                                    Cambiar contraseña
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesion
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

            </div>
            <div id="content-body">
                @yield('content')
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="pb-2 footer-admin">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; Huella-Digital</span>
                    </div>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro de querer cerrar la sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="/admin-marcshuttle/logout">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal update data current user -->
    <div class="modal fade" id="modalDatosUser" tabindex="-1" aria-labelledby="modalDatosUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDatosUserLabel">Datos usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="modal-body" id="form-current-user">
                <div class="form-outline mb-4">
                    <label class="form-label" for="currentFirstName" style="margin-left: 0px;">Nombres*</label>
                    <input type="text" name="currentFirstName" id="currentFirstName" class="form-control required" />
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="currentLastName" style="margin-left: 0px;">Apellidos*</label>
                    <input type="text" name="currentLastName" id="currentLastName" class="form-control required" />
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="currentEmail" style="margin-left: 0px;">Email*</label>
                    <input type="email" name="currentEmail" id="currentEmail" class="form-control required" />
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="updateCurrenUser()" >Guardar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal update password -->
    <div class="modal fade" id="modalChangePassword" tabindex="-1" aria-labelledby="modalChangePasswordLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalChangePasswordLabel">Cambio de contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="modal-body" id="form-change-password">
                <p class="text-secondary font-weight-bold">La contraseña debe contener por lo menos una mayuscula, una minuscula y un numero.</p>
                <div class="form-outline mb-4">
                    <label class="form-label" for="currentPassword" style="margin-left: 0px;">Contraseña actual</label>
                    <input type="text" name="currentPassword" id="currentPassword" class="form-control required" />
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="newPassword" style="margin-left: 0px;">Nueva contraseña</label>
                    <input type="text" name="newPassword" id="newPassword" class="form-control required">
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="updatePassword()">Cambiar contraseña</button>
            </div>
            </div>
        </div>
    </div>

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/alerts.js')}}"></script>
    <script src="{{ asset('js/main.js')}}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/admin/utils.js') }}"></script>

    @stack('scripts')

    <script type="text/javascript">
        function openChangePasswordModal() {
            var formChangePasswordModal = document.getElementById('form-change-password');
            formChangePasswordModal.reset();
            $('#modalChangePassword').modal('show');
        }
    </script>

</body>

</html>
