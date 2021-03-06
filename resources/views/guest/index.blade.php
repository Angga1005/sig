<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>SIG</title>
    <link rel="apple-touch-icon" href="{{asset('asset/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('asset/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/pages/page-auth.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('asset/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

    <!-- leaftlet Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <!-- WhatsApp -->
    <link rel="stylesheet" href="{{ asset('css/floating.css') }}">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <style>
        #mapid { height: 520px; }
    </style>
    <!-- BEGIN: Content-->
    <div class="container">
        <div class="app-content content" style="margin-top: 32px;">
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-9">
                                <h2 class="float-left mb-0">Sistem Informasi Geografis Kec.Margaasih</h2>
                            </div>
                            <div class="col-3">
                                <div class="text-right">
                                    <a href="{{route('login')}}" class="btn btn-primary btn-sm">Login</a>
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
                                    <strong>Info:</strong> Selamat datang di Sistem Informasi Geografis Kec.Margaasih.
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
                </div>
            </div>
        </div>
    </div>
    <div id="whatsapp"></div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('asset/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('asset/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('asset/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('asset/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('asset/app-assets/js/scripts/pages/page-auth-login.js')}}"></script>
    <!-- END: Page JS-->

    <!-- WhatsApp -->
    <script src="{{ asset('js/floating.js') }}"></script>

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
                    url: "{{route('guest.getLocation')}}",
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


            $(function () {
                $('#whatsapp').floatingWhatsApp({
                    phone: '+62 823-1657-6231',
                    message: "Hallo admin :)",
                    showPopup: true,
                    zIndex: 999
                });
            });
        })
    </script>
</body>
<!-- END: Body-->

</html>