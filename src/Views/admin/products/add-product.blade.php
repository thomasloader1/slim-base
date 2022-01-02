@php
$menuSection = 'products';
$subMenuSection = 'products';
$idTemporal = rand(1000, 2000);
if (!isset($_SESSION)) {
    session_start();
}
@endphp

@extends('layouts.admin')

@section('admin.styles')

    <link rel="stylesheet" href="{{ siteUrl('adm_assets/css/vendor/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ siteUrl('adm_assets/css/vendor/datatables.responsive.bootstrap4.min.css') }}">
    <link href="{{ siteUrl('adm_assets/js/vendor/dropzone/css/dropzone.css') }}" rel="stylesheet" />
    <link href="{{ siteUrl('adm_assets/css/vendor/select2.min.css') }}" rel="stylesheet" />

    <style>
        .dropzone .dz-preview .dz-error-message {
            top: 150px !important;
        }

        .dropzone .dz-preview .dz-image img {
            object-fit: fill !important;
            width: 100% !important;
        }

    </style>
@endsection
@section('admin.main')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Crear producto</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item"><a href="{{ siteUrl('/admin/products') }}">Listado de productos</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Crear producto</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>



        <form id="saveForm" action="{{ siteUrl('/admin/forms/products/add') }}" method="POST"
            enctype="multipart/form-data">

            <input type="hidden" name="idTemporal" id="" value="{{ $idTemporal }}">

            <div class="form-group row">
                <label for="category" class="col-sm-2 col-form-label">Categoria del producto</label>
                <div class="col-sm-10">
                    <select name="category" id="category" class="select2 form-control" aria-placeholder="Seleccione un tipo"
                        required>
                        <option value="" disabled selected hidden>Seleccione tipo...</option>
                        {{-- @foreach ($categories as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="brand" class="col-sm-2 col-form-label">Marca del producto</label>
                <div class="col-sm-10">
                    <select name="brand" id="brand" class="select2 form-control" aria-placeholder="Seleccione una marca"
                        required>
                        <option value="" disabled selected hidden>Seleccione tipo...</option>
                        {{-- @foreach ($brand as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del producto" value=""
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Precio</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="price" name="price" placeholder="Precio del producto"
                        value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="currency" class="col-sm-2 col-form-label">Divisa</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="currency" name="currency" placeholder="Seleccionar divisa"
                        value="">
                </div>
            </div>
            <hr>
            <h4 class="font-weight-bolder mb-3">Datos para el envio</h4>
            <div class="form-group row">
                <label for="shipping_weight" class="col-sm-2 col-form-label">Peso del paquete</label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" id="shipping_weight" name="shipping_weight"
                        placeholder="Peso del paquete." value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="shipping_height" class="col-sm-2 col-form-label">Altura del paquete</label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" id="shipping_height" name="shipping_height"
                        placeholder="Alto del paquete." value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="shipping_width" class="col-sm-2 col-form-label">Ancho del paquete</label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" id="shipping_width" name="shipping_width"
                        placeholder="Ancho del paquete." value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="shipping_length" class="col-sm-2 col-form-label">Largo del paquete</label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" id="shipping_length" name="shipping_length"
                        placeholder="Largo del paquete." value="">
                </div>
            </div>
            <hr>
            <h4 class="font-weight-bolder mb-3">Detalles del producto</h4>
            <div class="form-group row">
                <label for="bonus" class="col-sm-2 col-form-label">Bonus</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="bonus" name="bonus" placeholder="Bonus del producto"
                        value=""></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="weight" class="col-sm-2 col-form-label">Peso</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="weight" name="weight" placeholder="Peso en KG" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="dimention" class="col-sm-2 col-form-label">Dimensiones del producto</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="dimention" name="dimention"
                        placeholder="Alto, ancho y profundidad." value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Descripción</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="ckEditorClassic" name="description" placeholder="Descripción"
                        value=""></textarea>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 30px">
                <label class="form-label">Imagenes de Producto</label>

                <div id="my-dropzone" class="dropzone">
                    <div class="fallback">
                        <input name="image" type="file" multiple="multiple">
                    </div>
                </div>
            </div>

            <div class="card col-12 mb-4">
                <div class="card-body">



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




@endsection

@section('admin.scripts')
    <script src="{{ siteUrl('adm_assets/js/vendor/select2.full.js') }}"></script>
    <script src="{{ siteUrl('adm_assets/js/vendor/datatables/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="{{ siteUrl('adm_assets/js/vendor/ckeditor5-build-classic/ckeditor.js') }}"></script>

    <script src="{{ siteUrl('adm_assets/js/vendor/dropzone/dropzone.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#brand").select2({
                placeholder: "Seleccionar marca",
                language: "es",
                width: "100%",
                ajax: {
                    url: "{{ siteUrl('/admin/select/brands') }}",
                    dataType: 'json'
                }
            });

            $("#category").select2({
                placeholder: "Seleccionar categoría",
                language: "es",
                width: "100%",
                ajax: {
                    url: "{{ siteUrl('/admin/select/categories') }}",
                    dataType: 'json'
                }
            });

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
                scroll: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    fireSuccess('Producto creado con éxito');
                    setTimeout(() => {
                        $(window).attr('location',
                            "{{ siteUrl('/admin/products') }}");
                    }, 350);
                }
            });
        });

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

        var cleanFilename = function(name) {
            return Math.random().toString(36).substr(2, 9) + '_' + name.toLowerCase().replace(/[^\w.\/ ]+/g,
                '').replace(/ +/g, '-');
        };
        Dropzone.autoDiscover = false;
        Dropzone.prototype.defaultOptions.dictDefaultMessage = "Suelte aquí las imagenes o haga clic";
        Dropzone.prototype.defaultOptions.addRemoveLinks = true;
        Dropzone.prototype.defaultOptions.dictRemoveFile = "Borrar";
        Dropzone.prototype.defaultOptions.acceptedFiles = "image/*";

        var myDropzone = new Dropzone("#my-dropzone", {

            url: "{{ siteUrl('/admin/forms/products/images/add/' . $idTemporal) }}",
            addRemoveLinks: true,
            renameFilename: cleanFilename,
            acceptedFiles: "image/jpeg,image/png,image/gif",

            dictRemoveFile: "Borrar",

            removedfile: function(file) {
                var size = file.size;
                var ancho = file.width;
                var alto = file.height;
                $.ajax({
                    type: 'GET',
                    url: "{{ siteUrl('/admin/forms/products/images/add/' . $idTemporal) }}",
                    data: "tamano=" + size + "&ancho=" + ancho + "&alto=" + alto,
                    success: function(data) {


                    }
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file
                    .previewElement) : void 0;
            }


        });


        Dropzone.autoDiscover = false;
    </script>
@endsection
