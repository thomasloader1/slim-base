<?php $__env->startSection('styles'); ?>
    <link href="<?php echo e(siteUrl('adm_assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')); ?>" rel="stylesheet" />
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
            
            <?php if($user->role==1): ?>
            <h4 class="page-title"> <i class="dripicons-meter"></i> Dashboard</h4>
            <?php else: ?>
            <h4>Los recibos estarán disponibles el segundo día hábil de cada mes.
            </h4>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if($user->role==1): ?>
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="card text-center m-b-30">
            <div class="mb-2 card-body text-muted">
                <h3 id="kpi_tot" class="text-purple">0</h3>
                Agentes totales
            </div>
        </div>
    </div>
</div>
<?php else: ?>

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title">Recibos</h4>
                

                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Año</th>
                            <th>Mes</th>
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

<?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

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
    <script>



        var G = null;
        
        $(document).ready(function() {
        // G = Morris.Bar({
        //     data: [],
        //     element: 'morris-bar-example',
        //     xkey: 'y',
        //     ykeys: ['a', 'b','c','d'],
        //     labels:  ['Ingresos', 'Egresos','Rechazos','Permisos'],
        //     gridLineColor: 'rgba(255,255,255,0.1)',
        //     gridTextColor: '#98a6ad',
        //     barSizeRatio: 0.4,
        //     resize: true,
        //     hideHover: 'auto',
        //     barColors: ['#8862e0','#3be262','#f24734','#4bbbce']
        // });
        <?php if($user->role==1): ?>
            $.ajax({
                type: 'GET',
                url: "<?php echo e(siteUrl('dashboard/graph')); ?>",
                success: function(data) {
                        $("#kpi_tot").html(data.kpi.total);
                    
                }
            });
        <?php else: ?>

        var table = $('#datatable').DataTable({
                "dom": "<'row'<'col-sm-12 col-md-6'><'col-sm-12 col-md-6'>><'row'<'col-sm-12't>><'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                },
                "ajax":{
                    'url': "<?php echo e(siteUrl('/tables/paychecks/'.$user->id)); ?>",
                    complete: function() {

                    }
                }
            });

        <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/nicolasmolina/Sites/salliquelo-recibos/src/Views/admin/dashboard.blade.php ENDPATH**/ ?>