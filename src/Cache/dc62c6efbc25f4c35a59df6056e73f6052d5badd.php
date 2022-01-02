<?php $__env->startSection('styles'); ?>
    <link href="<?php echo e(siteUrl('adm_assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/fullcalendar/css/fullcalendar.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/alertify/css/alertify.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/dropify/css/dropify.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/jquery-ui/jquery-ui.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/datatables/buttons.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/datatables/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(siteUrl('adm_assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" />
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top-content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            
            <h4 class="page-title"> <i class="fa fa-user"></i> Usuarios</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                    <h4 class="mt-0 header-title">Listado de usuarios</h4>

                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    
            </div>
        </div>
           
    </div>
</div>


                                        <div id="modal-edit-user" class="modal fade" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div id="modal-edit-user-content" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0">Editar Usuario</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body" id="modal-edit-user-body">
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar cambios</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="modal-add-user" class="modal fade" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div id="modal-add-user-content" class="modal-content">
                                                    <form id="addUser" action="<?php echo e(siteUrl('/forms/users/add')); ?>" method="POST">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0">Agregar Usuario</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body" id="modal-add-user-body">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label" for="modal-add-user-name" >Nombre</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text" value="" id="modal-add-user-name" name="modal-add-user-name" placeholder="Nombre del usuario" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label" for="modal-add-user-email" >Email</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="email" value="" id="modal-add-user-email" name="modal-add-user-email" placeholder="nombre@ejemplo.com" parsley-type="email" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label" for="modal-add-user-role" >Contraseña</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="password" value="" id="modal-add-user-pass" name="modal-add-user-pass" placeholder="Contraseña" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label" for="modal-add-user-role" >Repetir contraseña</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="password" value="" placeholder="Contraseña" required data-parsley-equalto="#modal-add-user-pass">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label" for="modal-add-user-role" >Rol</label>
                                                                <div class="col-sm-10">
                                                                    <select id="modal-add-user-role" name="modal-add-user-role" class="form-control select2" required>
                                                                        <option value="1" selected>Administrador</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<script src="<?php echo e(siteUrl('adm_assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/alertify/js/alertify.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/dropify/js/dropify.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>

<script src="<?php echo e(siteUrl('adm_assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/datatables/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/datatables/buttons.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(siteUrl('adm_assets/plugins/datatables/jszip.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/datatables/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/datatables/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/datatables/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/datatables/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/datatables/buttons.colVis.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/parsleyjs/parsley.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/parsleyjs/i18n/es.js')); ?>"></script>

<script src="<?php echo e(siteUrl('adm_assets/plugins/select2/js/select2.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(siteUrl('adm_assets/plugins/select2/js/i18n/es.js')); ?>" type="text/javascript"></script>

    <script>

        function deleteUser(user_id){

            Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: true,
                showCancelButton: true,
                timerProgressBar: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                }).fire({
                        icon: 'warning',
                        title: '¿Seguro que quiere eliminar?',
                        confirmButtonText: 'Si, eliminar',
                        cancelButtonText: 'Cancelar!'
                    }).then((result) => {
                        if(result.isConfirmed){
                            $.ajax({
                                type: 'delete',
                                url: "<?php echo e(siteUrl('/forms/users')); ?>/"+user_id,
                                success: function(data) {
                                    $('#datatable').DataTable().ajax.reload(); 
                                    fireSuccess('Eliminado exitoso');
                                }
                            });
                        }
                    
                })
        }

        function toogleEditModal(user_id){
            $("#modal-edit-user").modal('toggle');
            // console.log(component_id);
            $.ajax({
                url: "<?php echo e(siteUrl('/forms/users/edit')); ?>",
                type: "GET",
                data: {id:user_id},
                cache: false,
                success: function (data) {
                    $("#modal-edit-user-content").html(data);
                    $("#editUser").submit(function(e) {
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
                                $("#modal-edit-user").modal('toggle');
                                $('#datatable').DataTable().ajax.reload(); 
                                
                                fireSuccess('Guardado con éxito');
                            }
                        });
                    });
                }
            });
        }

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
            
            $("#addUser").parsley();
            
            var table = $('#datatable').DataTable({
                "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>><'row'<'col-sm-12't>><'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",
                "processing": true,
                "serverSide": true,
                "ordering": false,
                buttons: [{
                    text: 'Agregar usuario',
                    action: function ( e, dt, node, config ) {
                        $("#modal-add-user").modal('toggle');
                    }
                }],
                "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                },
                "ajax":{
                    'url': "<?php echo e(siteUrl('/tables/users')); ?>"
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
                        fireSuccess('Guardado exitoso');
                    }
                });
            });
            
            
            $(".select2").select2();
            $("#modal-add-user-company-id").select2({
                placeholder: "Seleccione un expositor",
                language: "es",
                ajax: {
                    url: "<?php echo e(siteUrl('/selects/company')); ?>",
                    dataType: 'json'
                }
            });

            $("#modal-add-user-role").on('select2:selecting', function(e) {
                $("#modal-add-user-company-id").prop('disabled', (e.params.args.data.id == 1));
            });


            $("#addUser").submit(function(e) {
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
                                table.ajax.reload(); 
                                $("#modal-add-user").modal('toggle');
                                $("#modal-add-user-name").val('');
                                $("#modal-add-user-email").val('');
                                $("#modal-add-user-pass").val('');
                                fireSuccess('Creado con éxito');
                            }
                        });
                    });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/nicolasmolina/Sites/salliquelo-recibos/src/Views/admin/users.blade.php ENDPATH**/ ?>