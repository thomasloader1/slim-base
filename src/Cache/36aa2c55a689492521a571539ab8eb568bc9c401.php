<?php $__env->startSection('styles'); ?>
    <link href="<?php echo e(siteUrl('adm_assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/fullcalendar/css/fullcalendar.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/alertify/css/alertify.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/dropify/css/dropify.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/jquery-ui/jquery-ui.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />

    <link href="<?php echo e(siteUrl('adm_assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('top-content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <?php if($user->role>1): ?>
            <form class="float-right">
                <a href="<?php echo e(siteUrl('/')); ?>"><button type="button" class="btn btn-outline-light waves-effect waves-light">Volver</button></a>
            </form>
            <?php endif; ?>
            <h4 class="page-title"> <i class="fa fa-user"></i> Editar perfil</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<form id="saveForm" action="<?php echo e(siteUrl('/forms/account/edit')); ?>" enctype="multipart/form-data">
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                    <h4 class="mt-0 header-title">Datos del usuario</h4>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="user-name" >Nombre</label>
                        <div class="col-sm-10">
                        <input class="form-control" type="text" value="<?php echo e($user->name); ?><?php if($user->role>1): ?> <?php echo e(' '.$user->apellido); ?> <?php endif; ?>" placeholder="Ingrese su nombre" id="user-name" name="user-name" <?php if($user->role>1): ?> readonly <?php endif; ?>>
                        </div>
                    </div>
    <?php if($user->role == 1): ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="user-email">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" value="<?php echo e($user->email); ?>" id="user-email" name="user-email" placeholder="nombre@ejemplo.com" parsley-type="email" required>
                        </div>
                    </div>
    <?php endif; ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="user-pass">Nueva contraseña</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" value="" id="user-pass" name="user-pass" placeholder="Ingrese contraseña nueva si desea cambiarla">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="user-repeat-pass">Repetir contraseña</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" value="" id="user-repeat-pass" placeholder="Repetir contraseña" data-parsley-equalto="#user-pass">
                        </div>
                    </div>
                    
                    <div class="form-group pull-right">
                        <div>
                            <button id="btnSave" type="submit" class="btn btn-primary waves-effect waves-light">
                                Guardar cambios
                            </button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</form>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script src="<?php echo e(siteUrl('adm_assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/alertify/js/alertify.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/dropify/js/dropify.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>



<script src="<?php echo e(siteUrl('adm_assets/plugins/select2/js/select2.full.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/select2/js/i18n/es.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/parsleyjs/parsley.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/parsleyjs/i18n/es.js')); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.0/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone-with-data.js" integrity="sha512-ECoTMVFwwVtxjEBRjUMjviUd6hBjwDhBJI0+3W2YDs+ld5rHHUDr59T15gxwEPkGu5XLmkASUSvPgQe/Tpyodg==" crossorigin="anonymous"></script>

    <script>
        

        function fireSuccess(title){
            Swal.mixin({
                                    toast: true,
                                    position: 'top',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: false,
                                    onOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                }).fire({
                                    icon: 'success',
                                    title: title
                                });
        }

        $(document).ready(function() {
            
            $("#saveForm").parsley();
            $('.dropify').dropify({
                messages: {
                    'default': 'Arrastre imagen o haga click para seleccionar',
                    'replace': 'Reemplazar la imagen',
                    'remove':  'Eliminar',
                    'error':   'Hubo un error, intentelo de nuevo'
                }
            });
            
            $("#saveForm").submit(function(e) {
                e.preventDefault(); 
                var fd = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: fd,
                    cache: false,
                    async: true,
                    scroll:true,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        fireSuccess('Guardado con éxito');
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/nicolasmolina/Sites/salliquelo-recibos/src/Views/account.blade.php ENDPATH**/ ?>