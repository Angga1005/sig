@extends('layouts.index')

@section('title')
    Dashboard
@endsection

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<style>
    #mapid { height: 360px; }
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
        <div id="mapid"></div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        var mymap = L.map('mapid').setView([-6.954021, 107.5573539], 13);
        L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=qV9MVb9MCmtigCZVDpqs', {
            attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
        }).addTo(mymap);
        // var klinik = L.marker([-6.954021, 107.5573539]).addTo(mymap);
        // klinik.bindPopup("<b>Ini adalah Klinik Angga Yudisman.</b>").openPopup();

        // var apotek = L.marker([-6.9341465, 107.5433088]).addTo(mymap);
        // apotek.bindPopup("<b>Ini adalah Apotek Angga Yudisman.</b>").openPopup();

        $(document).ready(function () {
            var _token = '{{ csrf_token() }}';
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });

            $.ajax({
                url: "{{route('admin.getLocation')}}",
                method: "POST",
                success: function (resp) {
                    $.each(resp.data, function(key, value) {
                        // console.log(value)
                        var marker = L.marker([value.longitude, value.latitude]).addTo(mymap);
                        marker.bindPopup("<b>"+value.name+".</b><br>"+value.address+"");
                    });
                }
            })
        })
    </script>
@endsection