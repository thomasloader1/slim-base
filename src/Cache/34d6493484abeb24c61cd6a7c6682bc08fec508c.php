<?php
$menuSection = 'settings';
$subMenuSection = 'settings.users';
?>



<?php $__env->startSection('admin.styles'); ?>

    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/css/vendor/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/css/vendor/datatables.responsive.bootstrap4.min.css')); ?>">    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin.main'); ?>
    
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Usuarios</h1>
            
            <div class="separator mb-5"></div>
            <div class="mb-2"><a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse"
                    href="#displayOptions" role="button" aria-expanded="true"
                    aria-controls="displayOptions">Opciones <i
                        class="simple-icon-arrow-down align-middle"></i></a>
                <div class="collapse dont-collapse-sm" id="displayOptions">
                    <div class="d-block d-md-inline-block">
                        <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top"><input
                                class="form-control" placeholder="Buscar" id="searchDatatable"></div>
                    </div>
                    <div class="float-md-right dropdown-as-select">
                        <button class="btn btn-outline-dark btn-xs" type="button" data-toggle="modal" data-target="#modal-add-user">Agregar usuario</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                <table id="tabla-nueva" class="data-table responsive nowrap"
                    data-order="[[ 1, &quot;desc&quot; ]]">
                    <thead>
                        <tr>
                            <th>Mail</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
    </div>
</div>


<div id="modal-add-user" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="modal-add-user-content" class="modal-content">
            <form id="addUser" action="<?php echo e(siteUrl('/admin/forms/users/add')); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                </div>
                <div class="modal-body" id="modal-add-user-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="modal-add-user-name" >Nombre</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="" id="modal-add-user-name" name="modal-add-user-name" placeholder="Nombre del usuario" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="modal-add-user-username" >Usuario</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="" id="modal-add-user-username" name="modal-add-user-username" placeholder="Nombre que usar?? para ingresar" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="modal-add-user-email" >Email</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" value="" id="modal-add-user-email" name="modal-add-user-email" placeholder="nombre@ejemplo.com" parsley-type="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="modal-add-user-pass" >Contrase??a</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" value="" id="modal-add-user-pass" name="modal-add-user-pass" placeholder="Contrase??a" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="modal-add-user-repeat-pass" >Repetir contrase??a</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" value="" id="modal-add-user-repeat-pass" placeholder="Contrase??a" required data-parsley-equalto="#modal-add-user-pass">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="modal-add-user-role" >Rol</label>
                        <div class="col-sm-10">
                            <select id="modal-add-user-role" name="modal-add-user-role" class="form-control select2" required>
                                <option value="1">Administrador </option>
                                <option value="2">Editor</option>
                                <option value="3">Ventas</option>
                                <option value="4">Ventas MercadoLibre</option>
                                <option value="5">Ventas Web</option>
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


<div id="modal-edit-user" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div id="modal-edit-user-content" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
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


<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin.scripts'); ?>
    
<script src="<?php echo e(siteUrl('adm_assets/js/vendor/datatables/datatables.min.js')); ?>"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script>

        function toogleEditModal(user_id){
            $("#modal-edit-user").modal('toggle');
            // console.log(component_id);
            $.ajax({
                url: "<?php echo e(siteUrl('/admin/forms/users/edit')); ?>",
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
                                fireSuccess('Guardado con ??xito');
                            }
                        });
                    });
                }
            });
        }

        function deleteUser(id){
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
                            title: '??Seguro que quiere eliminar?',
                            confirmButtonText: 'Si, eliminar',
                            cancelButtonText: 'Cancelar!'
                        }).then((result) => {
                            $.ajax({
                            type: 'delete',
                            url: "<?php echo e(siteUrl('/admin/forms/users')); ?>/"+id,
                            success: function(data) {
                                $('#tabla-nueva').DataTable().ajax.reload();
                                fireSuccess('Eliminado exitoso');
                            }
                        });
                    })
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
            

            var table = $('#tabla-nueva').DataTable({
                "dom": "<'row'<'col-sm-12't>><'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",
                // "dom": '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "language": {
                        "url": "<?php echo e(siteUrl('/adm_assets/js/vendor/datatables/i18n/Spanish.json')); ?>"
                },
                "ajax":{
                    'url': "<?php echo e(siteUrl('/admin/tables/users')); ?>"
                }
            });
            $("#searchDatatable").on("keyup", (function(e) {
                table.search($(this).val()).draw()
            }));
            $("#pageCountDatatable .dropdown-menu a").on("click", (function(e) {
                var t = $(this).text();
                ce.page.len(parseInt(t)).draw()
            }));

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
                                $("#modal-add-user-username").val('');
                                $("#modal-add-user-email").val('');
                                $("#modal-add-user-pass").val('');
                                fireSuccess('Creado con ??xito');
                            }
                        });
                    });

            $(".trash-component").click(function(){
                
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/nicolasmolina/Sites/ecommerce/src/Views/admin/users.blade.php ENDPATH**/ ?>