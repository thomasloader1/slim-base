<?php
$menuSection = 'website';
$subMenuSection = 'website.add-banner';
?>



<?php $__env->startSection('admin.styles'); ?>

    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/css/vendor/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(siteUrl('adm_assets/css/vendor/datatables.responsive.bootstrap4.min.css')); ?>">
    <link href="<?php echo e(siteUrl('adm_assets/js/vendor/dropify/css/dropify.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin.main'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Agregar banner</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="<?php echo e(siteUrl('/admin/banners')); ?>">Listado de banners</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Agregar banner</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>
        <div class="row">
            <div class="card col-12 mb-4">
                <div class="card-body">
                    <form id="saveForm" action="<?php echo e(siteUrl('/admin/forms/banners/add')); ?>" method="POST"
                        enctype="multipart/form-data">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="banner-file">
                                Banner
                            </label>
                            <div class="col-sm-10">
                                <input name="banner-file" id="banner-file" type="file" class="dropify" data-height="100"
                                    data-allowed-file-extensions="jpg png jpeg" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="banner-type" class="col-sm-2 col-form-label">Tipo de banner</label>
                            <div class="col-sm-10">
                                <select name="banner-type" id="banner-type" class="form-control"
                                    aria-placeholder="Seleccione un tipo" required>
                                    <option value="" disabled selected hidden>Seleccione tipo...</option>
                                    <?php $__currentLoopData = $banner_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="banner-name" class="col-sm-2 col-form-label">Nombre identificador</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="banner-name" name="banner-name"
                                    placeholder="Nombre para identificar el banner en el panel" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="banner-title" class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="banner-title" name="banner-title"
                                    placeholder="Título del banner" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="banner-description" class="col-sm-2 col-form-label">Bajada</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="banner-description" name="banner-description"
                                    placeholder="Bajada  del banner" value=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary mb-0 float-right"
                                    onclick="limpiarFormulario()">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
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

    <script src="<?php echo e(siteUrl('adm_assets/js/vendor/dropify/js/dropify.min.js')); ?>"></script>
    <script>


        function toogleEditModal(user_id) {
            $("#modal-edit-user").modal('toggle');
            // console.log(component_id);
            $.ajax({
                url: "<?php echo e(siteUrl('/admin/forms/users/edit')); ?>",
                type: "GET",
                data: {
                    id: user_id
                },
                cache: false,
                success: function(data) {
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
                            scroll: true,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                $("#modal-edit-user").modal('toggle');
                                $('#datatable').DataTable().ajax.reload();
                                fireSuccess('Guardado con éxito');
                            }
                        });
                    });
                }
            });
        }

        function deleteUser(id) {
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
                $.ajax({
                    type: 'delete',
                    url: "<?php echo e(siteUrl('/admin/forms/users')); ?>/" + id,
                    success: function(data) {
                        $('#tabla-nueva').DataTable().ajax.reload();
                        fireSuccess('Eliminado exitoso');
                    }
                });
            })
        }

        function fireSuccess(title) {
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

            $('.dropify').dropify({
                messages: {
                    'default': 'Arrastre imagen del banner o haga click para seleccionar',
                    'replace': 'Reemplazar la imagen de banner',
                    'remove': 'Eliminar',
                    'error': 'Hubo un error, intentelo de nuevo'
                }
            });


            var table = $('#tabla-nueva').DataTable({
                "dom": "<'row'<'col-sm-12't>><'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",
                // "dom": '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "language": {
                    "url": "<?php echo e(siteUrl('/adm_assets/js/vendor/datatables/i18n/Spanish.json')); ?>"
                },
                "ajax": {
                    'url': "<?php echo e(siteUrl('/admin/tables/banners')); ?>"
                },
                "columns": [{
                        "render": function(data, type, row, meta) {
                            var myImage = $('<img/>');
                            myImage.attr('height', 80);
                            myImage.attr('class',
                                "list-thumbnail responsive border-0 card-img-left");
                            myImage.attr('src', row[0]);

                            return myImage.wrap('<div></div>')
                                .parent()
                                .html();
                        }
                    },
                    {
                        "data": 1
                    }, {
                        "data": 2
                    }, {
                        "data": 3
                    }
                ],
                "columnDefs": [{
                    targets: 0,
                    className: 'first-column'
                }]
            });
            $("#searchDatatable").on("keyup", (function(e) {
                table.search($(this).val()).draw()
            }));
            $("#pageCountDatatable .dropdown-menu a").on("click", (function(e) {
                var t = $(this).text();
                ce.page.len(parseInt(t)).draw()
            }));

            $("#saveForm").submit(function(e) {
                e.preventDefault();
                var fd = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: fd,
                    cache: false,
                    async: true,
                    scroll: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        fireSuccess('Creado con éxito');
                        $("#saveForm").trigger("reset");
                    }
                });
            });

            $(".trash-component").click(function() {

            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-commerce\src\Views/admin/banners/add.blade.php ENDPATH**/ ?>