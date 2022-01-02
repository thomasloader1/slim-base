<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ecommerce Admin</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <link rel="stylesheet" href="{{ siteUrl('adm_assets/font/iconsmind-s/css/iconsminds.css') }}">
    <link rel="stylesheet" href="{{ siteUrl('adm_assets/font/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ siteUrl('adm_assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ siteUrl('adm_assets/css/vendor/bootstrap.rtl.only.min.css') }}">
    <link rel="stylesheet" href="{{ siteUrl('adm_assets/css/vendor/component-custom-switch.min.css') }}">
    <link rel="stylesheet" href="{{ siteUrl('adm_assets/css/vendor/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ siteUrl('adm_assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ siteUrl('adm_assets/js/vendor/sweetalert2/sweetalert2.min.css') }}" />

    @yield('admin.styles')

</head>

<body id="app-container" class="menu-default show-spinner">
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="#" class="menu-button d-none d-md-block">
                <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg>
            </a>
            <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg>
            </a>
        </div>
        <a class="navbar-logo" href="{{ siteUrl('/admin') }}">
            <span class="logo d-none d-xs-block"></span>
            <span class="logo-mobile d-block d-xs-none"></span>
        </a>
        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">
                <div class="d-none d-md-inline-block align-text-bottom mr-3">
                    <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1"
                        data-toggle="tooltip" data-placement="left" title="Modo oscuro">
                        <input class="custom-switch-input" id="switchDark" type="checkbox" checked="checked">
                        <label class="custom-switch-btn" for="switchDark"></label>
                    </div>
                </div>


                {{-- Menu desplegable
                    
                    <div class="position-relative d-none d-sm-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-grid"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="iconMenuDropdown">
                        <a href="#" class="icon-menu-item">
                            <i class="iconsminds-equalizer d-block"></i>
                            <span>Settings</span>
                        </a>
                        <a href="#" class="icon-menu-item">
                            <i class="iconsminds-male-female d-block"></i>
                            <span>Users</span>
                        </a>
                        <a href="#" class="icon-menu-item">
                            <i class="iconsminds-puzzle d-block"></i>
                            <span>Components</span>
                        </a>
                        <a href="#" class="icon-menu-item">
                            <i class="iconsminds-bar-chart-4 d-block"></i>
                            <span>Profits</span>
                        </a>
                        <a href="#" class="icon-menu-item">
                            <i class="iconsminds-file d-block"></i>
                            <span>Surveys</span>
                        </a>
                        <a href="#" class="icon-menu-item">
                            <i class="iconsminds-suitcase d-block"></i>
                            <span>Tasks</span>
                        </a>
                    </div>
                </div> --}}


                {{-- Centro de notificaciones
                    
                    <div class="position-relative d-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="notificationButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-bell"></i>
                        <span class="count">3</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="notificationDropdown">
                        <div class="scroll">
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom"><a href="#"><img
                                        src="img/profiles/l-2.jpg" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle"></a>
                                <div class="pl-3"><a href="#">
                                        <p class="font-weight-medium mb-1">Joisse Kaycee just sent a new comment!</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a></div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom"><a href="#"><img
                                        src="img/notifications/1.jpg" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle"></a>
                                <div class="pl-3"><a href="#">
                                        <p class="font-weight-medium mb-1">1 item is out of stock!</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a></div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom"><a href="#"><img
                                        src="img/notifications/2.jpg" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle"></a>
                                <div class="pl-3"><a href="#">
                                        <p class="font-weight-medium mb-1">New order received! It is total $147,20.</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a></div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3"><a href="#"><img src="img/notifications/3.jpg"
                                        alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle"></a>
                                <div class="pl-3"><a href="#">
                                        <p class="font-weight-medium mb-1">3 items just added to wish list by a user!
                                        </p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- Botón pantalla completa --}}
                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>
            </div>
            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name">{{ $user->name }}</span>
                    <span>
                        <img alt="avatar" src="{{ siteUrl('/adm_assets/img/profiles/l-2.jpg') }}">
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3">
                    {{-- <a class="dropdown-item" href="#">Account</a>
                    <a class="dropdown-item" href="#">Features</a>
                    <a class="dropdown-item" href="#">History</a>
                    <a class="dropdown-item" href="#">Support</a> --}}
                    <a class="dropdown-item" href="{{ siteUrl('/admin/account') }}">Perfil</a>
                    <a class="dropdown-item" href="{{ siteUrl('/admin/logout') }}">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="menu">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled">
                    <li @if ($menuSection == 'dashboard') class="active" @endif><a href="#dashboard"><i class="iconsminds-shop-4"></i>
                            <span>Dashboards</span></a></li>
                    <li @if ($menuSection == 'website') class="active" @endif><a href="#website"><i class="iconsminds-digital-drawing"></i> Página web</a>
                    </li>
                    <li @if ($menuSection == 'products') class="active" @endif><a href="#products"><i class="iconsminds-box-close"></i> Productos</a></li>
                    <li @if ($menuSection == 'sales') class="active" @endif><a href="#sales"><i class="simple-icon-basket-loaded"></i> Ventas</a></li>
                    <li @if ($menuSection == 'settings') class="active" @endif><a href="#settings"><i class="iconsminds-gears"></i>Configuración</a></li>
                </ul>
            </div>
        </div>
        <div class="sub-menu">
            <div class="scroll">
                <ul class="list-unstyled" data-link="dashboard">
                    <li @if ($subMenuSection == 'dashboard.home') class="active" @endif>
                        <a href="{{ siteUrl('/admin') }}">
                            <i class="simple-icon-pie-chart"></i>
                            <span class="d-inline-block">Analytics</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="simple-icon-basket-loaded"></i>
                            <span class="d-inline-block">Ventas</span>
                        </a>
                    </li>
                </ul>

                <ul class="list-unstyled" data-link="website" id="website">
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#website-banners-menu" aria-expanded="true"
                            aria-controls="website-banners-menu" class="rotate-arrow-icon opacity-50">
                            <i class="simple-icon-arrow-down"></i>
                            <span class="d-inline-block">Banners</span>
                        </a>
                        <div id="website-banners-menu" class="collapse show">
                            <ul class="list-unstyled inner-level-menu">
                                <li @if ($subMenuSection == 'website.add-banner') class="active" @endif>
                                    <a href="{{ siteUrl('/admin/banners/add') }}">
                                        <i class="simple-icon-note"></i>
                                        <span class="d-inline-block">Crear banner</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-unstyled inner-level-menu">
                                <li @if ($subMenuSection == 'website.banners') class="active" @endif>
                                    <a href="{{ siteUrl('/admin/banners') }}">
                                        <i class="simple-icon-list"></i>
                                        <span class="d-inline-block">Listado de banners</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#website-others-menu" aria-expanded="true"
                            aria-controls="website-others-menu" class="rotate-arrow-icon opacity-50">
                            <i class="simple-icon-arrow-down"></i>
                            <span class="d-inline-block">Otros</span>
                        </a>
                        <div id="website-others-menu" class="collapse show">
                            <ul class="list-unstyled inner-level-menu">
                                <li>
                                    <a href="#">
                                        <i class="simple-icon-question"></i>
                                        <span class="d-inline-block">Preguntas frequentes</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-unstyled inner-level-menu">
                                <li>
                                    <a href="#">
                                        <i class="iconsminds-embassy"></i>
                                        <span class="d-inline-block">Legales</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

                <ul class="list-unstyled" data-link="products" id="products">

                    <li @if ($subMenuSection == 'products') class="active" @endif>
                        <a href="{{ siteUrl('/admin/products') }}">
                            <i class="simple-icon-grid"></i>
                            <span class="d-inline-block">Ver productos</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" data-toggle="collapse" data-target="#products-category-menu" aria-expanded="true"
                            aria-controls="products-category-menu" class="rotate-arrow-icon collapsed opacity-50">
                            <i class="simple-icon-arrow-down"></i>
                            <span class="d-inline-block">Categorías</span>
                        </a>
                        
                        <div id="products-category-menu" class="collapse show" >
                            <ul class="list-unstyled inner-level-menu">
                                <li @if ($subMenuSection == 'products.categories') class="active" @endif>
                                    <a href="{{ siteUrl('/admin/categories') }}">
                                        <i class="simple-icon-list"></i>
                                        <span class="d-inline-block">Administrar categorías</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-unstyled inner-level-menu" >
                                <li @if ($subMenuSection == 'products.sub-categories') class="active" @endif>
                                    <a href="#">
                                        <i class="simple-icon-list"></i>
                                        <span class="d-inline-block">Administrar subcategorías</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#products-brands-menu" aria-expanded="true"
                            aria-controls="products-brands-menu" class="rotate-arrow-icon collapsed opacity-50">
                            <i class="simple-icon-arrow-down"></i>
                            <span class="d-inline-block">Marcas</span>
                        </a>
                        <div id="products-brands-menu" class="collapse show">
                            <ul class="list-unstyled inner-level-menu">
                                <li @if ($subMenuSection == 'products.add-brand') class="active" @endif>
                                    <a href="{{ siteUrl('/admin/brands/add') }}">
                                        <i class="simple-icon-note"></i>
                                        <span class="d-inline-block">Crear marca</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-unstyled inner-level-menu">
                                <li @if ($subMenuSection == 'products.brand') class="active" @endif>
                                    <a href="{{ siteUrl('/admin/brands') }}">
                                        <i class="simple-icon-list"></i>
                                        <span class="d-inline-block">Listado de marcas</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

                <ul class="list-unstyled" data-link="sales">
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#sales-mercadolibre-menu" aria-expanded="true"
                            aria-controls="sales-mercadolibre-menu" class="rotate-arrow-icon opacity-50">
                            <i class="simple-icon-arrow-down"></i>
                            <span class="d-inline-block">MercadoLibre</span>
                        </a>
                        <div id="sales-mercadolibre-menu" class="collapse show">
                            <ul class="list-unstyled inner-level-menu">
                                <li>
                                    <a href="Ui.Forms.Components.html">
                                        <i class="simple-icon-mercadolibre"></i>
                                        <span class="d-inline-block">Listado de publicaciones</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-unstyled inner-level-menu">
                                <li>
                                    <a href="Ui.Forms.Components.html">
                                        <i class="iconsminds-timer"></i>
                                        <span class="d-inline-block">Publicaciones pendientes</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-unstyled inner-level-menu">
                                <li>
                                    <a href="Ui.Forms.Components.html">
                                        <i class="simple-icon-settings"></i><span
                                            class="d-inline-block">Configuraciones</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#sales-web-menu" aria-expanded="true"
                            aria-controls="sales-web-menu" class="rotate-arrow-icon opacity-50">
                            <i class="simple-icon-arrow-down"></i>
                            <span class="d-inline-block">Ventas web</span>
                        </a>
                        <div id="sales-web-menu" class="collapse show">
                            <ul class="list-unstyled inner-level-menu">
                                <li>
                                    <a href="Ui.Forms.Components.html">
                                        <i class="simple-icon-list"></i>
                                        <span class="d-inline-block">Listado de ventas</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-unstyled inner-level-menu">
                                <li>
                                    <a href="Ui.Forms.Components.html">
                                        <i class="simple-icon-settings"></i><span
                                            class="d-inline-block">Configuraciones</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

                <ul class="list-unstyled" data-link="settings">
                    <li>
                        <a href="Ui.Forms.Components.html">
                            <i class="iconsminds-jeep"></i>
                            <span class="d-inline-block">Envíos</span>
                        </a>
                    </li>
                    <li @if ($subMenuSection == 'settings.users') class="active" @endif>
                        <a href="{{ siteUrl('/admin/users') }}">
                            <i class="simple-icon-people"></i>
                            <span class="d-inline-block">Usuarios</span>
                        </a>
                    </li>

                    <li>
                        <a href="Ui.Forms.Components.html">
                            <i class="iconsminds-gears"></i>
                            <span class="d-inline-block">Configuraciones generales</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <main>

        @yield('admin.main')

    </main>
    <footer class="page-footer">
        <div class="footer-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <p class="mb-0 text-muted">Desarrollado por <a href="https://www.anteojosnegros.com"
                                target="_blank">AnteojosNegros</a></p>
                    </div>
                    <div class="col-sm-6 d-none d-sm-block">
                        <ul class="breadcrumb pt-0 pr-0 float-right">
                            {{-- <li class="breadcrumb-item mb-0"><a href="#" class="btn-link">Review</a></li>
                            <li class="breadcrumb-item mb-0"><a href="#" class="btn-link">Purchase</a></li>
                            <li class="breadcrumb-item mb-0"><a href="#" class="btn-link">Docs</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ siteUrl('adm_assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ siteUrl('adm_assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ siteUrl('adm_assets/js/vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ siteUrl('adm_assets/js/vendor/mousetrap.min.js') }}"></script>
    <script src="{{ siteUrl('adm_assets/js/dore.script.js') }}"></script>
    <script src="{{ siteUrl('adm_assets/js/scripts.js') }}"></script>
    <script src="{{ siteUrl('adm_assets/js/vendor/sweetalert2/sweetalert2.min.js') }}"></script>

    @yield('admin.scripts')

</body>

</html>
