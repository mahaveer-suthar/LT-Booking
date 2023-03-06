<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LT-Booking</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    {{-- <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png"> --}}
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('font/flaticon.css') }}">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    	{{-- toast message --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

</head>

<body>
    <nav class="navbar navbar-light bg-light justify-content-end">
        <form id="logout-form" action="{{ route('logout') }}" method="POST"
        style="display: none;">
        @csrf
    </form>
    
    <a class="p-0"
        href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
            class="fa fa-fw fa-test" data-feather="log-out"></i>Log out</a>
      </nav>

      
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div id="preloader" class="preloader">
        <div class='inner'>
            <div class='line1'></div>
            <div class='line2'></div>
            <div class='line3'></div>
        </div>
    </div>
    <section class="fxt-template-animation fxt-template-layout9" data-bg-image="{{asset('img/figure/bg9-l.jpg')}}">
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="fxt-header">
                        <a href="{{ route('user.home') }}" class="fxt-logo"><img src="{{asset('img/logo-9.svg')}}" alt="Logo"></a>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a type="button" href="{{route('user.booking.index')}}" class="fxt-btn">Book an LT</a>
                        <a href="{{route('user.booking.show',Auth::user()->id)}}" class="fxt-btn px-3" style="background-color: #3221d2;">Booking Status</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="fxt-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jquery-->
    {{-- <script src="{{ asset('js/jquery-3.5.0.min.js') }}"></script> --}}
    <!-- Bootstrap js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Imagesloaded js -->
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- Validator js -->
    <script src="{{ asset('js/validator.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('js/main.js') }}"></script>
    {{-- for date picker --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    @yield('jquery')
</body>

</html>
