@php
$menuSection = 'products';
$subMenuSection = 'products.categories';
$idTemporal = rand(1000, 2000);
if (!isset($_SESSION)) {
    session_start();
}
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
                <h1>Editar producto</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="{{ siteUrl('/admin/categories') }}">Listado de categorias</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Editar categoria</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>
        <div class="row">
            <div class="card col-12 mb-4">
                <div class="card-body">
                    <form id="saveForm" action="{{ siteUrl('/admin/categories/edit/') . $product->id }}" method="POST"
                        enctype="multipart/form-data">


                        <input type="hidden" name="idTemporal" id="" value="{{ $idTemporal }}">


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="banner-file">
                                Banner
                            </label>
                            <div class="col-sm-10">
                                <input name="category-file" id="category-file" type="file" class="dropify" data-height="100"
                                    data-allowed-file-extensions="jpg png jpeg" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nombre de la categoría</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nombre del producto" value="{{ $product->name }}">
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
                url: "{{ siteUrl('/admin/forms/categories/edit') }}",
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
                    url: "{{ siteUrl('/admin/forms/categories') }}/" + id,
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

        var cleanFilename = function(name) {
            return Math.random().toString(36).substr(2, 9) + '_' + name.toLowerCase().replace(/[^\w.\/ ]+/g,
                '').replace(/ +/g, '-');
        };

        $('.dropify').dropify({
                messages: {
                    'default': 'Arrastre imagen del banner o haga click para seleccionar',
                    'replace': 'Reemplazar la imagen de banner',
                    'remove': 'Eliminar',
                    'error': 'Hubo un error, intentelo de nuevo'
                }
            });




        $(document).ready(function() {

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
                        fireSuccess('Banner modificado con éxito');
                        setTimeout(() => {
                            $(window).attr('location',
                                "{{ siteUrl('/admin/categories') }}");
                        }, 350);
                    }
                });
            });

            $(".trash-component").click(function() {

            });
        });
    </script>
@endsection
