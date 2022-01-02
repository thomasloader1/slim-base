<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ecommerce Admin</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/font/iconsmind-s/css/iconsminds.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/font/simple-line-icons/css/simple-line-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/css/vendor/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/css/vendor/bootstrap.rtl.only.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/css/vendor/component-custom-switch.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/css/vendor/perfect-scrollbar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/js/vendor/sweetalert2/sweetalert2.min.css')); ?>"/>

    <?php echo $__env->yieldContent('admin.styles'); ?>

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
        <a class="navbar-logo" href="<?php echo e(siteUrl('/admin')); ?>">
            <span class="logo d-none d-xs-block"></span>
            <span class="logo-mobile d-block d-xs-none"></span>
        </a>
        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">
                <div class="d-none d-md-inline-block align-text-bottom mr-3">
                    <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1" data-toggle="tooltip" data-placement="left" title="Modo oscuro">
                        <input class="custom-switch-input" id="switchDark" type="checkbox" checked="checked">
                        <label class="custom-switch-btn" for="switchDark"></label>
                    </div>
                </div>


                


                

                
                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>
            </div>
            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="name"><?php echo e($user->name); ?></span>
                    <span>
                        <img alt="avatar" src="<?php echo e(siteUrl('/adm_assets/img/profiles/l-2.jpg')); ?>">
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3">
                    
                    <a class="dropdown-item" href="<?php echo e(siteUrl('/admin/account')); ?>">Perfil</a>
                    <a class="dropdown-item" href="<?php echo e(siteUrl('/admin/logout')); ?>">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="menu">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled">
                    <li <?php if($menuSection == 'dashboard'): ?> class="active" <?php endif; ?>><a href="#dashboard"><i class="iconsminds-shop-4"></i> <span>Dashboards</span></a></li>
                    <li <?php if($menuSection == 'website'): ?> class="active" <?php endif; ?>><a href="#website"><i class="iconsminds-digital-drawing"></i> Página web</a></li>
                    <li <?php if($menuSection == 'products'): ?> class="active" <?php endif; ?>><a href="#products"><i class="iconsminds-box-close"></i> Productos</a></li>
                    <li <?php if($menuSection == 'sales'): ?> class="active" <?php endif; ?>><a href="#sales"><i class="simple-icon-basket-loaded"></i> Ventas</a></li>
                    <li <?php if($menuSection == 'settings'): ?> class="active" <?php endif; ?>><a href="#settings"><i class="iconsminds-gears"></i>Configuración</a></li>
                </ul>
            </div>
        </div>
        <div class="sub-menu">
            <div class="scroll">
                <ul class="list-unstyled" data-link="dashboard">
                    <li <?php if($subMenuSection == 'dashboard.home'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo e(siteUrl('/admin')); ?>">
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
                        <a href="#" data-toggle="collapse" data-target="#website-banners-menu" aria-expanded="true" aria-controls="website-banners-menu" class="rotate-arrow-icon opacity-50">
                            <i class="simple-icon-arrow-down"></i>
                            <span class="d-inline-block">Banners</span>
                        </a>
                        <div id="website-banners-menu" class="collapse show">
                            <ul class="list-unstyled inner-level-menu">
                                <li <?php if($subMenuSection == 'website.add-banner'): ?> class="active" <?php endif; ?> >
                                    <a href="<?php echo e(siteUrl('/admin/banners/add')); ?>">
                                        <i class="simple-icon-note"></i>
                                        <span class="d-inline-block">Crear banner</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-unstyled inner-level-menu">
                                <li <?php if($subMenuSection == 'website.banners'): ?> class="active" <?php endif; ?> >
                                    <a href="<?php echo e(siteUrl('/admin/banners')); ?>">
                                        <i class="simple-icon-list"></i>
                                        <span class="d-inline-block">Listado de banners</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#website-others-menu" aria-expanded="true" aria-controls="website-others-menu" class="rotate-arrow-icon opacity-50">
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
                    
                    <li>
                        <a href="<?php echo e(siteUrl('/admin/products')); ?>">
                            <i class="simple-icon-grid"></i> 
                            <span class="d-inline-block">Ver productos</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" data-toggle="collapse" data-target="#products-category-menu" aria-expanded="true" aria-controls="products-category-menu" class="rotate-arrow-icon collapsed opacity-50">
                            <i class="simple-icon-arrow-down"></i>
                            <span class="d-inline-block">Categorías</span>
                        </a>
                        <div id="products-category-menu" class="collapse">
                            <ul class="list-unstyled inner-level-menu">
                                <li>
                                    <a href="#">
                                        <i class="simple-icon-list"></i>
                                        <span class="d-inline-block">Administrar categorías</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-unstyled inner-level-menu">
                                <li>
                                    <a href="#">
                                        <i class="simple-icon-list"></i>
                                        <span class="d-inline-block">Administrar subcategorías</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#products-brands-menu" aria-expanded="true" aria-controls="products-brands-menu" class="rotate-arrow-icon collapsed opacity-50">
                            <i class="simple-icon-arrow-down"></i>
                            <span class="d-inline-block">Marcas</span>
                        </a>
                        <div id="products-brands-menu" class="collapse">
                            <ul class="list-unstyled inner-level-menu">
                                <li>
                                    <a href="#">
                                        <i class="simple-icon-note"></i>
                                        <span class="d-inline-block">Crear marca</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-unstyled inner-level-menu">
                                <li>
                                    <a href="#">
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
                        <a href="#" data-toggle="collapse" data-target="#sales-mercadolibre-menu" aria-expanded="true" aria-controls="sales-mercadolibre-menu" class="rotate-arrow-icon opacity-50">
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
                                        <i class="simple-icon-settings"></i><span class="d-inline-block">Configuraciones</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#sales-web-menu" aria-expanded="true" aria-controls="sales-web-menu" class="rotate-arrow-icon opacity-50">
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
                                        <i class="simple-icon-settings"></i><span class="d-inline-block">Configuraciones</span>
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
                    <li <?php if($subMenuSection == 'settings.users'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(siteUrl('/admin/users')); ?>">
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

        <?php echo $__env->yieldContent('admin.main'); ?>

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
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="<?php echo e(siteUrl('adm_assets/js/vendor/jquery-3.3.1.min.js')); ?>"></script>
    <script src="<?php echo e(siteUrl('adm_assets/js/vendor/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(siteUrl('adm_assets/js/vendor/perfect-scrollbar.min.js')); ?>"></script>
    <script src="<?php echo e(siteUrl('adm_assets/js/vendor/mousetrap.min.js')); ?>"></script>
    <script src="<?php echo e(siteUrl('adm_assets/js/dore.script.js')); ?>"></script>
    <script src="<?php echo e(siteUrl('adm_assets/js/scripts.js')); ?>"></script>
    <script src="<?php echo e(siteUrl('adm_assets/js/vendor/sweetalert2/sweetalert2.min.js')); ?>"></script>

    <?php echo $__env->yieldContent('admin.scripts'); ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\e-commerce\src\Views/layouts/admin.blade.php ENDPATH**/ ?>