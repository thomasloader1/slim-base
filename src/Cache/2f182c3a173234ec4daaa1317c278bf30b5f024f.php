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
            
            <h4 class="page-title"> <i class="mdi mdi-file-multiple"></i> Recibos</h4>
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
                <h4 class="mt-0 header-title">Seleccione agente</h4>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="modal-search-code-value" >Busque el agente</label>
                        <div class="col-sm-10">
                            <select id="select-employee" name="employee-id" class="form-control select2">
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="float-right">
                        <button id="btn-go" class="btn btn-primary waves-effect">Ver recibos</button>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
<?php if(!isset($agente)): ?>
                    <h4 class="mt-0 header-title">Seleccione agente</h4>
<?php else: ?>
                    <h4 class="mt-0 header-title">Recibos de: <?php echo e($agente->name.' '.$agente->apellido); ?></h4>
<?php endif; ?>

                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Legajo</th>
                                <th>Archivo</th>
                                <th>Año</th>
                                <th>Mes</th>
                                <th>Liquidación</th>
                                <th>Pago</th>
                                <th>Cargo</th>
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


                                        <div id="modal-edit-point" class="modal fade" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div id="modal-edit-point-content" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0">Editar Punto de control</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body" id="modal-edit-point-body">
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar cambios</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="modal-sync" class="modal fade" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div id="modal-sync-content" class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0">Sincronizar recibos</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body" id="modal-sync-body">
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancelar</button>
                                                            <button type="button" class="btn btn-primary waves-effect waves-light">Guardar</button>
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

        function deletePoint(point_id){

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
                                url: "<?php echo e(siteUrl('/forms/points')); ?>/"+point_id,
                                success: function(data) {
                                    $('#datatable').DataTable().ajax.reload(); 
                                    fireSuccess('Eliminado exitoso');
                                }
                            });
                        }
                })
        }

        function toogleEditModal(point_id){
            $("#modal-edit-point").modal('toggle');
            // console.log(component_id);
            $.ajax({
                url: "<?php echo e(siteUrl('/forms/points/edit')); ?>",
                type: "GET",
                data: {id:point_id},
                cache: false,
                success: function (data) {
                    $("#modal-edit-point-content").html(data);
                    $("#editPoint").submit(function(e) {
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
                                $("#modal-edit-point").modal('toggle');
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
            
            
            var table = $('#datatable').DataTable({
                "dom": "<'row'<'col-sm-12 col-md-6'><'col-sm-12 col-md-6'f>><'row'<'col-sm-12't>><'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                },
                "ajax":{
                    'url': "<?php echo e(siteUrl('/tables/paychecks/'.$agente->id)); ?>",
                    complete: function() {

                    }
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
            
            $("#select-employee").select2({
                placeholder: "Seleccione un agente",
                language: "es",
                ajax: {
                    url: "<?php echo e(siteUrl('/selects/employee')); ?>",
                    dataType: 'json'
                }
            });
            $("#btn-go").click( function(){
                var employee = $("#select-employee").val();
                if(employee){
                    window.location.href = "<?php echo e(siteUrl('/recibos/')); ?>"+employee;

                }else{
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
                                    icon: 'warning',
                                    title: 'Debe seleccionar un agente'
                                });
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/nicolasmolina/Sites/salliquelo-recibos/src/Views/admin/paychecks.blade.php ENDPATH**/ ?>