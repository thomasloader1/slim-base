@php
$menuSection = 'products';
$subMenuSection = 'products';
@endphp

@extends('layouts.admin')

@section('admin.styles')
    <link rel="stylesheet" href="{{siteUrl('adm_assets/css/vendor/styles2.css')}}">
    <link rel="stylesheet" href="{{siteUrl('adm_assets/css/vendor/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{siteUrl('adm_assets/css/vendor/datatables.responsive.bootstrap4.min.css')}}">    
@endsection

@section('admin.main')
    
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Ordenar productos</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="{{ siteUrl('/admin/products') }}">Listado de productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ordenar</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="row mb-4 sortable" id="list_sort">
                @foreach ($product->images as $imagen)
                <div class="col-12 mb-4" data-id="{{$imagen->id}}">
                    <div class="card d-flex flex-row mb-3">
                        <img src="{{siteUrl($imagen->path)}}" alt="" class="list-thumbnail responsive border-0 card-img-left">
                        <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@section('admin.scripts')
    
<script src="{{siteUrl('adm_assets/js/vendor/datatables/datatables.min.js')}}"></script>
<script src="{{siteUrl('adm_assets/js/vendor/Sortable.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
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
                                data: {images:arr},
                                url: "{{siteUrl('/admin/products/image-sort')}}",
                                success: function(data) {
                                    fireSuccess('Reordenado exitoso');
                                    }
                                });
                        }
                    }
                });
            });
        });

    </script>
@endsection