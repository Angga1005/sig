@extends('layouts.index')

@section('title')
    Dashboard
@endsection

@section('content')
<link 
    href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
    rel="stylesheet"  type='text/css'>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<style>
    #mapid { height: 420px; }
</style>
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Dashboard</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-primary" role="alert">
                    <div class="alert-body">
                        <strong>Info:</strong> Selamat datang di Dashboard Sistem Informasi Geografis Kec.Margaasih.
                    </div>
                </div>
            </div>
        </div>
        <form id="filter-category">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="category_id" id="all" value="">
                <label class="form-check-label" for="all">All</label>
            </div>
            @foreach ($categories as $category)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="category_id" id="{{$category->name}}" value="{{$category->id}}">
                    <label class="form-check-label" for="{{$category->name}}">{{$category->name}}</label>
                </div>
            @endforeach
        </form>
        <div id="mapid"></div>
        <div style="margin:16px; padding-bottom:8px;">
            <div class="row">
                @foreach ($pois as $poi)
                    <div class="col-xl-{{$column}} col-md-6 mb-4 d-flex">
                        <div class="card border-left-primary shadow h-80 py-2" style="width: 100%;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{$poi->category->name}}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$poi->count}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-home fa-2x text-gray-300"></i>
                                    </div>
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

@section('scripts')
    <script>
        var mymap = L.map('mapid').setView([-6.954021, 107.5573539], 13);
        L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=qV9MVb9MCmtigCZVDpqs', {
            attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
        }).addTo(mymap);

        $(document).ready(function () {
            var _token = '{{ csrf_token() }}';
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });

            $('input[type=radio][name=category_id]').change(function() {
                var category_id = $(this).val();
                $('.leaflet-marker-pane').empty();
                
                $.ajax({
                    url: "{{route('admin.getLocation')}}",
                    method: "POST",
                    data: {category_id: category_id},
                    success: function (resp) {
                        console.log(resp.data);
                        $.each(resp.data, function(key, value) {
                            var greenIcon = new L.Icon({
                                iconUrl: value.category.icon_url,
                                // shadowUrl: "img/marker-icon-green.png",
                                iconSize: [40, 41],
                                iconAnchor: [12, 41],
                                popupAnchor: [1, -34],
                                shadowSize: [41, 41]
                            });
                            var marker = L.marker([value.longitude, value.latitude], {icon: greenIcon}).addTo(mymap);
                            marker.bindPopup('<b>'+value.name+'.</b><br>'+value.address+'<br><a href="https://wa.me/'+value.phone+'/?text=Hallo admin" target="_blank">Contact</a><br><hr><span>'+value.description+'</span>');
                        });
                    }
                })
            });
        })
    </script>
@endsection