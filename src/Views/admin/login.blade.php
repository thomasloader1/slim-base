<!DOCTYPE html>
    <html lang="es">
    
    <head>
        <meta charset="UTF-8">
        <title>Ecommerce Admin</title>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
        <link rel="stylesheet" href="{{siteUrl('adm_assets/font/iconsmind-s/css/iconsminds.css')}}">
        <link rel="stylesheet" href="{{siteUrl('adm_assets/font/simple-line-icons/css/simple-line-icons.css')}}">
        <link rel="stylesheet" href="{{siteUrl('adm_assets/css/vendor/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{siteUrl('adm_assets/css/vendor/bootstrap.rtl.only.min.css')}}">
        <link rel="stylesheet" href="{{siteUrl('adm_assets/css/vendor/bootstrap-float-label.min.css')}}">
        <link rel="stylesheet" href="{{siteUrl('adm_assets/css/main.css')}}">
    </head>
    
    <body class="background show-spinner no-footer">
        <div class="fixed-background"></div>
        <main>
            <div class="container">
                <div class="row h-100">
                    <div class="col-12 col-md-10 mx-auto my-auto">
                        <div class="card auth-card">
                            <div class="position-relative image-side">
                                <p class="text-white text-center h2">MAYORISTA CERÁMICOS</p>
                            </div>
                            <div class="form-side">
                                <a href="#">
                                    <span class="logo-single"></span>
                                </a>
                                <h6 class="mb-4">Iniciar sesión</h6>
                                <form method="POST"  action="{{siteUrl('/admin/login')}}" method="post">
                                    <label class="form-group has-float-label mb-4">
                                        <input name="name" class="form-control">
                                        <span>Nombre de usuario</span>
                                    </label>
                                    <label class="form-group has-float-label mb-4">
                                        <input name="password" class="form-control" type="password" placeholder="">
                                        <span>Contraseña</span>
                                    </label>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="{{siteUrl('adm_assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
        <script src="{{siteUrl('adm_assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
        <script src="{{siteUrl('adm_assets/js/dore.script.js')}}"></script>
        <script src="{{siteUrl('adm_assets/js/scripts.js')}}"></script>
    </body>
    
    </html>