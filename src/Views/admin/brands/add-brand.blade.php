@php
$menuSection = 'products';
$subMenuSection = 'products.add-brand';
@endphp

@extends('layouts.admin')

@section('admin.styles')

    <link rel="stylesheet" href="{{ siteUrl('adm_assets/css/vendor/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ siteUrl('adm_assets/css/vendor/datatables.responsive.bootstrap4.min.css') }}">
    <link href="{{ siteUrl('adm_assets/js/vendor/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endsection

@section('admin.main')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Agregar marcas</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="{{ siteUrl('/admin/brands') }}">Listado de marcas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Crear marca</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>
        <div class="row">
            <div class="card col-12 mb-4">
                <div class="card-body">
                    <form id="saveForm" action="{{ siteUrl('/admin/brands/add') }}" method="POST"
                        enctype="multipart/form-data">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="banner-file">
                                Imagen
                            </label>
                            <div class="col-sm-10">
                                <input name="brand-file" id="brand-file" type="file" class="dropify" data-height="100"
                                    data-allowed-file-extensions="jpg png jpeg" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="brand-name" class="col-sm-2 col-form-label">Nombre de la marca</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="brand-name" name="brand-name"
                                    placeholder="Nombre de la marca" value="">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary mb-0 float-right">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('admin.scripts')

    <script src="{{ siteUrl('adm_assets/js/vendor/datatables/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

    <script src="{{ siteUrl('adm_assets/js/vendor/dropify/js/dropify.min.js') }}"></script>
    <script>
        function toogleEditModal(user_id) {
            $("#modal-edit-user").modal('toggle');
            // console.log(component_id);
            $.ajax({
                url: "{{ siteUrl('/admin/forms/users/edit') }}",
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
                    url: "{{ siteUrl('/admin/forms/users') }}/" + id,
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
                    "url": "{{ siteUrl('/adm_assets/js/vendor/datatables/i18n/Spanish.json') }}"
                },
                "ajax": {
                    'url': "{{ siteUrl('/admin/tables/brands') }}"
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
                        fireSuccess('Marca creada con éxito');
                        setTimeout(() => {
                            $(window).attr('location',
                                "{{ siteUrl('/admin/brands') }}");
                        }, 350);
                    }
                });
            });

            $(".trash-component").click(function() {

            });
        });
    </script>
@endsection
