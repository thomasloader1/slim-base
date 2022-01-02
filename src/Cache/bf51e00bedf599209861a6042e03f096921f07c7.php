
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Municipalidad de Salliqueló | Admin</title>
        <meta content="Admin Dashboard" name="description" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="<?php echo e(siteUrl('/img/favicon.ico')); ?>">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/plugins/morris/morris.css')); ?>">

        <!-- App css --> 
        <link href="<?php echo e(siteUrl('adm_assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(siteUrl('adm_assets/css/icons.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(siteUrl('adm_assets/css/style.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(siteUrl('adm_assets/plugins/summernote/summernote-bs4.css')); ?>" rel="stylesheet" />

        <?php echo $__env->yieldContent('styles'); ?>

    </head>


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>
        <div class="header-bg">
            <!-- Navigation Bar-->
            <header id="topnav">
                <div class="topbar-main">
                    <div class="container-fluid">

                        <!-- Logo container-->
                        <div class="logo">
                            <!-- Text Logo -->
                            
                            <!-- Image Logo -->
                            <a href="<?php echo e(siteUrl('/')); ?>" class="logo">
                                <img src="<?php echo e(siteUrl('img/logo_chico.png')); ?>" alt="" height="auto" class="logo-small">
                                <img src="<?php echo e(siteUrl('img/logo.png')); ?>" alt="" height="auto" top="0" class="logo-large">
                            </a> 

                        </div>
                        <!-- End Logo container-->


                        <div class="menu-extras topbar-custom">

                            <ul class="list-inline float-right mb-0">
                                
                                
                                <!-- User-->
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        <img src="<?php echo e(siteUrl('adm_assets/images/users/blank_avatar.jpg')); ?>" alt="user" class="rounded-circle">
                                        <span class="ml-1"><?php echo $user->name;?> <i class="mdi mdi-chevron-down"></i> </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <a class="dropdown-item" href="<?php echo e(siteUrl('/account')); ?>"><i class="dripicons-user text-muted"></i> Perfil</a>
                                        
                                        
                                        <!-- <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i> Lock screen</a> -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?php echo e(siteUrl('/logout')); ?>"><i class="dripicons-exit text-muted"></i> Cerrar sesión</a>
                                    </div>
                                </li>
                                <li class="menu-item list-inline-item">
                                    <!-- Mobile menu toggle-->
                                    <a class="navbar-toggle nav-link">
                                        <div class="lines">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <!-- End mobile menu toggle-->
                                </li>

                            </ul>
                        </div>
                        <!-- end menu-extras -->

                        <div class="clearfix"></div>

                    </div> <!-- end container -->
                </div>
                <!-- end topbar-main -->

                <!-- MENU Start -->
                <div class="navbar-custom">
                    <div class="container-fluid">
                        <div id="navigation">
                            <!-- Navigation Menu-->
                            <ul class="navigation-menu">
                                
                                <?php if($user->role != 1): ?>

                                
                                <?php else: ?>
                                
                                <li class="has-submenu">
                                    <a href="<?php echo e(siteUrl('/')); ?>"><i class="fa fa-pie-chart"></i>Estadísticas</a>
                                </li>

                                <li class="has-submenu">
                                    <a href="<?php echo e(siteUrl('/agentes')); ?>"><i class="fa fa-users"></i>Agentes</a>
                                </li>

                                <li class="has-submenu">
                                    <a href="<?php echo e(siteUrl('/recibos')); ?>"><i class="mdi mdi-file-multiple"></i>Recibos</a>
                                </li>

                                <li class="has-submenu">
                                    <a href="<?php echo e(siteUrl('/usuarios')); ?>"><i class="fa fa-user"></i>Usuarios admin</a>
                                </li>


                                <?php endif; ?>
                                
                            </ul>
                            <!-- End navigation menu -->
                        </div> <!-- end #navigation -->
                    </div> <!-- end container -->
                </div> <!-- end navbar-custom -->
            </header>
            <!-- End Navigation Bar-->

            <div class="container-fluid">
                
                <?php echo $__env->yieldContent('top-content'); ?>
                <!-- Page-Title -->
            </div>
        </div>


        <div class="wrapper">
            <div class="container-fluid">
                <?php echo $__env->yieldContent('content'); ?>
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        © 2021 Municipalidad de Salliqueló | by <a href="https://anteojosnegros.com" target="_blank" style="color: #111;font-weight: 600;">AnteojosNegros</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->


        <!-- jQuery  -->
        <script src="<?php echo e(siteUrl('adm_assets/js/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(siteUrl('adm_assets/js/bootstrap.bundle.min.js')); ?>"></script>
        <script src="<?php echo e(siteUrl('adm_assets/js/modernizr.min.js')); ?>"></script>
        <script src="<?php echo e(siteUrl('adm_assets/js/waves.js')); ?>"></script>
        <script src="<?php echo e(siteUrl('adm_assets/js/jquery.slimscroll.js')); ?>"></script>
        <script src="<?php echo e(siteUrl('adm_assets/js/jquery.nicescroll.js')); ?>"></script>
        <script src="<?php echo e(siteUrl('adm_assets/js/jquery.scrollTo.min.js')); ?>"></script>

        <!--Morris Chart-->
        <script src="<?php echo e(siteUrl('adm_assets/plugins/morris/morris.min.js')); ?>"></script>
        <script src="<?php echo e(siteUrl('adm_assets/plugins/raphael/raphael-min.js')); ?>"></script>

        <script src="<?php echo e(siteUrl('adm_assets/plugins/moment/moment.js')); ?>"></script>
        
        <!-- App js -->
        <script src="<?php echo e(siteUrl('adm_assets/js/app.js')); ?>"></script>
        <!-- summernote -->
        <script src="<?php echo e(siteUrl('adm_assets/plugins/summernote/summernote-bs4.min.js')); ?>" type="text/javascript"></script>

        <script>
            function showShareModal(){
                $("#modal-share").modal('show');

            }
            jQuery(document).ready(function(){
                
                        $('.summernote').summernote({
                            height: 300,                 // set editor height
                            minHeight: null,             // set minimum height of editor
                            maxHeight: null,             // set maximum height of editor
                            focus: true                 // set focus to editable area after initializing summernote
                        });
                    });
                    
        </script>

        <?php echo $__env->yieldContent('js'); ?>

    </body>
</html><?php /**PATH /Users/nicolasmolina/Sites/salliquelo-recibos/src/Views/layouts/admin.blade.php ENDPATH**/ ?>