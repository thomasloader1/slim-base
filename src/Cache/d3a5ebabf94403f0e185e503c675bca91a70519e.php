<?php
$menuSection = 'website';
$subMenuSection = 'website.banners';
?>



<?php $__env->startSection('admin.styles'); ?>

    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/css/vendor/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/css/vendor/datatables.responsive.bootstrap4.min.css')); ?>">    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin.main'); ?>
    
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Ordenar banners</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(siteUrl('/admin/banners')); ?>">Listado de banners</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ordenar</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="row mb-4 sortable" id="list_sort">
                <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 mb-4" data-id="<?php echo e($banner->id); ?>">
                    <div class="card d-flex flex-row mb-3">
                        <img src="<?php echo e(siteUrl($banner->path_background)); ?>" alt="" class="list-thumbnail responsive border-0 card-img-left">
                        <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                <p class="mb-0 text-muted text-small w-15 w-sm-100"><?php echo e($banner->name); ?></p>
                                <p class="mb-0 text-muted text-small w-15 w-sm-100"><?php echo e($banner->type_details->name); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin.scripts'); ?>
    
<script src="<?php echo e(siteUrl('adm_assets/js/vendor/datatables/datatables.min.js')); ?>"></script>
<script src="<?php echo e(siteUrl('adm_assets/js/vendor/Sortable.js')); ?>"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script>

        // function toogleEditModal(user_id){
        //     $("#modal-edit-user").modal('toggle');
        //     // console.log(component_id);
        //     $.ajax({
        //         url: "<?php echo e(siteUrl('/admin/forms/users/edit')); ?>",
        //         type: "GET",
        //         data: {id:user_id},
        //         cache: false,
        //         success: function (data) {
        //             $("#modal-edit-user-content").html(data);
        //             $("#editUser").submit(function(e) {
        //                 e.preventDefault();
        //                 var fd = new FormData(this);
        //                 $.ajax({
        //                     url: $(this).attr('action'),
        //                     type: "POST",
        //                     data: fd,
        //                     cache: false,
        //                     async: true,
        //                     scroll:true,
        //                     contentType: false,
        //                     processData: false,
        //                     success: function (data) {
        //                         $("#modal-edit-user").modal('toggle');
        //                         $('#datatable').DataTable().ajax.reload();
        //                         fireSuccess('Guardado con éxito');
        //                     }
        //                 });
        //             });
        //         }
        //     });
        // }

        // function deleteUser(id){
        //     Swal.mixin({
        //         toast: true,
        //         position: 'top',
        //         showConfirmButton: true,
        //         showCancelButton: true,
        //         timerProgressBar: false,
        //         customClass: {
        //             confirmButton: 'btn btn-success',
        //             cancelButton: 'btn btn-danger'
        //         },
        //         buttonsStyling: false
        //         }).fire({
        //                     icon: 'warning',
        //                     title: '¿Seguro que quiere eliminar?',
        //                     confirmButtonText: 'Si, eliminar',
        //                     cancelButtonText: 'Cancelar!'
        //                 }).then((result) => {
        //                     $.ajax({
        //                     type: 'delete',
        //                     url: "<?php echo e(siteUrl('/admin/forms/users')); ?>/"+id,
        //                     success: function(data) {
        //                         $('#tabla-nueva').DataTable().ajax.reload();
        //                         fireSuccess('Eliminado exitoso');
        //                     }
        //                 });
        //             })
        // }

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
            
            
            $(".sortable").each(function() {
                Sortable.create($(this)[0],{
                    store: {
                        get: function (sortable) {
                            var order = localStorage.getItem(sortable.options.group.name);
                            return order ? order.split('|') : [];
                        },
                        set: function (sortable) {
                            var arr = sortable.toArray();
                            localStorage.setItem(sortable.options.group.name, arr.join('|'));
                            
                            $.ajax({
                                type: 'post',
                                data: {banners:arr},
                                url: "<?php echo e(siteUrl('/admin/banners/forms/sort')); ?>",
                                success: function(data) {
                                    fireSuccess('Reordenado exitoso');
                                    }
                                });
                        }
                    }
                });
            });
        });

        //     var table = $('#tabla-nueva').DataTable({
        //         "dom": "<'row'<'col-sm-12't>><'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",
        //         // "dom": '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
        //         "processing": true,
        //         "serverSide": true,
        //         "ordering": false,
        //         "language": {
        //                 "url": "<?php echo e(siteUrl('/adm_assets/js/vendor/datatables/i18n/Spanish.json')); ?>"
        //         },
        //         "ajax":{
        //             'url': "<?php echo e(siteUrl('/admin/tables/banners')); ?>"
        //         },
        //         "columns": [ {
        //             "render": function(data, type, row, meta) {
        //                 var myImage = $('<img/>');
        //                 myImage.attr('height', 80);
        //                 myImage.attr('class', "list-thumbnail responsive border-0 card-img-left");
        //                 myImage.attr('src', row[0]);

        //                 return myImage.wrap('<div></div>')
        //                     .parent()
        //                     .html();
        //                 }
        //         },
        //         {
        //             "data": 1
        //         }, {
        //             "data": 2
        //         }, {
        //             "data": 3
        //         }],
        //         "columnDefs":[
        //             {
        //             targets: 0,
        //             className: 'first-column'
        //             }
        //         ]
        //     });
        //     $("#searchDatatable").on("keyup", (function(e) {
        //         table.search($(this).val()).draw()
        //     }));
        //     $("#pageCountDatatable .dropdown-menu a").on("click", (function(e) {
        //         var t = $(this).text();
        //         ce.page.len(parseInt(t)).draw()
        //     }));

        //     $("#addUser").submit(function(e) {
        //                 e.preventDefault();
        //                 var fd = new FormData(this);
        //                 $.ajax({
        //                     url: $(this).attr('action'),
        //                     type: "POST",
        //                     data: fd,
        //                     cache: false,
        //                     async: true,
        //                     scroll:true,
        //                     contentType: false,
        //                     processData: false,
        //                     success: function (data) {
        //                         table.ajax.reload(); 
        //                         $("#modal-add-user").modal('toggle');
        //                         $("#modal-add-user-name").val('');
        //                         $("#modal-add-user-username").val('');
        //                         $("#modal-add-user-email").val('');
        //                         $("#modal-add-user-pass").val('');
        //                         fireSuccess('Creado con éxito');
        //                     }
        //                 });
        //             });

        //     $(".trash-component").click(function(){
                
        //     });
        // });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/nicolasmolina/Sites/ecommerce/src/Views/admin/banners/sort.blade.php ENDPATH**/ ?>