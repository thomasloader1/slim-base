@php
$menuSection = 'products';
$subMenuSection = 'products';
@endphp

@extends('layouts.admin')

@section('admin.styles')

    <link rel="stylesheet" href="{{ siteUrl('adm_assets/css/vendor/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ siteUrl('adm_assets/css/vendor/datatables.responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ siteUrl('adm_assets/css/switch.css') }}">
@endsection

@section('admin.main')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Listado de productos</h1>
                {{-- <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
            </nav> --}}
                <div class="separator mb-5"></div>
                <div class="mb-2"><a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse"
                        href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">Opciones <i
                            class="simple-icon-arrow-down align-middle"></i></a>
                    <div class="collapse dont-collapse-sm" id="displayOptions">
                        <div class="d-block d-md-inline-block">
                            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                <input class="form-control" placeholder="Buscar" id="searchDatatable">
                            </div>
                        </div>
                        <div class="float-md-right dropdown-as-select">
                            <button class="btn btn-outline-dark btn-xs" type="button" data-toggle="modal"
                                data-target="#modal-add-banner"><a href="{{ siteUrl('admin/products/add') }}"> Crear producto</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                <table id="tabla-nueva" class="data-table responsive nowrap" data-order="[[ 1, &quot;desc&quot; ]]">
                    <thead>
                        <tr>
                            <th>Preview</th>
                            <th>Activo</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Marca</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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
    <script>
        function toogleEditModal(user_id) {
            $("#modal-edit-user").modal('toggle');
            // console.log(component_id);
            $.ajax({
                url: "{{ siteUrl('/admin/forms/product/edit') }}",
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

        // FUNCION ACTIVAR BANNER

        function productosactivar(banner) {
            var t = document.getElementById("check-" + banner).checked;

            if (!t) {
                $.ajax({
                    url: '{{ siteUrl("/admin/forms/banners/active") }}',
                    type: 'POST',
                    data: {
                        id_banner: banner,
                        status: 0
                    },


                });
            } else {
                $.ajax({
                    url: '{{ siteUrl("/admin/forms/banners/active") }}',
                    type: 'POST',
                    data: {
                        id_banner: banner,
                        status: 1
                    }
                });
            }
        }

        function deleteProducts(id) {
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
                if (result.isConfirmed == true) {
                    $.ajax({
                        type: 'delete',
                        url: "{{ siteUrl('/admin/forms/products') }}/" + id,
                        success: function(data) {
                            $('#tabla-nueva').DataTable().ajax.reload();
                            fireSuccess('Eliminado exitoso');
                        }
                    })
                }
            });
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
                    'url': "{{ siteUrl('/admin/tables/products') }}"
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
                    }, {
                        "data": 4
                    },
                    {
                        "data": 5
                    },
                    
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

            $("#addUser").submit(function(e) {
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
                        table.ajax.reload();
                        $("#modal-add-user").modal('toggle');
                        $("#modal-add-user-name").val('');
                        $("#modal-add-user-username").val('');
                        $("#modal-add-user-email").val('');
                        $("#modal-add-user-pass").val('');
                        fireSuccess('Creado con éxito');
                    }
                });
            });

            $(".trash-component").click(function() {

            });
        });
    </script>
@endsection
