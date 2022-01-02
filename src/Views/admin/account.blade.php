@extends('layouts.admin')

@section('admin.styles')
    
<link href="{{siteUrl('adm_assets/js/vendor/dropify/css/dropify.min.css')}}" rel="stylesheet" />

@endsection

@section('admin.main')
    
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Datos del usuario</h1>
{{--             
            <div class="text-zero top-right-button-container">
                <button type="button"class="btn btn-primary btn-lg top-right-button mr-1">ADD NEW</button>
                <div class="btn-group">
                    <div class="btn btn-primary btn-lg pl-4 pr-0 check-button">
                        <label class="custom-control custom-checkbox mb-0 d-inline-block">
                            <input type="checkbox" class="custom-control-input" id="checkAll">
                            <span class="custom-control-label">&nbsp;</span>
                        </label>
                    </div>
                    <button type="button" class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                    </div>
                </div>
            </div> --}}
            <div class="separator mb-5">
            </div>
            

            <div class="card mb-4">
                <div class="card-body">
                    <form id="saveForm" action="{{siteUrl('/admin/forms/account/edit')}}" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="user-name" name="user-name" placeholder="Nombre" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="user-email" name="email" placeholder="Email" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pass" class="col-sm-2 col-form-label">Cambiar contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="user-pass" name="user-pass" placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="repeat_pass" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="user-repeat-pass" name="user-repeat-pass" placeholder="Reperir contraseña" data-parsley-equalto="#user-pass">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-sm-2 col-form-label">Rol</label>
                            <div class="col-sm-10">
                                <select name="user-role" id="user-role" class="form-control">
                                    <option disabled value="-1">Seleccione un rol</option>
                                    <option value="1" @if ($user->role==1) selected="selected" @endif>Administrador</option>
                                    <option value="2" @if ($user->role==2) selected="selected" @endif>Ventas</option>
                                    <option value="3" @if ($user->role==3) selected="selected" @endif>Marketing</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="user-avatar" >
                                Avatar
                            </label>
                            <div class="col-sm-10">
                            <input name="user-avatar" id="user-avatar" type="file" class="dropify" data-height="100" data-allowed-file-extensions="jpg png jpeg" data-default-file="{{siteUrl($user->avatar)}}"/>
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
</div>
@endsection

@section('admin.scripts')

    <script src="{{siteUrl('adm_assets/js/vendor/dropify/js/dropify.min.js')}}"></script>

    <script src="{{siteUrl('adm_assets/js/vendor/parsleyjs/parsley.min.js')}}"></script>
    <script src="{{siteUrl('adm_assets/js/vendor/parsleyjs/i18n/es.js')}}"></script>
    
    <script>
    
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

        $('.dropify').dropify({
                messages: {
                    'default': 'Arrastre imagen de avatar o haga click para seleccionar',
                    'replace': 'Reemplazar la imagen de avatar',
                    'remove':  'Eliminar',
                    'error':   'Hubo un error, intentelo de nuevo'
                }
            });
            
        $("#saveForm").parsley();
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
                    fireSuccess('Guardado con éxito');
                }
            });
        });
    });
            
    </script>
@endsection