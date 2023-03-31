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
    <style>
    .myButton {
    background: linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
    background-color: #7892c2;
    border-radius: 4px;
    border: 2px solid #4e6096;
    display: inline-block;
    cursor: pointer;
    color: #ffffff;
    font-family: Arial;
    font-size: 13px;
    padding: 5px 10px;
    text-decoration: none;
    text-shadow: 0px 1px 0px #283966;
}
    .myButton:hover {
        background:linear-gradient(to bottom, #476e9e 5%, #7892c2 100%) !important;
        background-color:#476e9e;
        color: white;
        text-decoration: none;
    }
    .myButton:active {
        position:relative;
        top:1px;
    }</style>
    <nav class="navbar navbar-light bg-light justify-content-end">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a class="myButton"
            href="{{ route('logout') }}"onclick="event.preventDefault(); alert('Are you sure'); document.getElementById('logout-form').submit();">Log out</a>
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
    <section class="fxt-template-animation fxt-template-layout9" data-bg-image="{{ asset('img/figure/bg9-l.jpg') }}">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="fxt-header">
                        <a href="{{ route('user.home') }}" class="fxt-logo"><img src="{{ asset('img/logo-9.svg') }}"
                                alt="Logo"></a>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button"
                            onclick="location.href='@if (auth()->user()->role == 3) {{ route('student.booking.index') }}@else {{ route('teacher.booking.index') }} @endif'"
                            class="fxt-btn">Book an LT</button>
                        <button type="button"
                            onclick="location.href='@if (auth()->user()->role == 3) {{ route('student.booking.show', Auth::user()->id) }} @else {{ route('teacher.booking.show', Auth::user()->id) }} @endif '"
                            class="fxt-btn px-3" style="background-color: #3221d2;">Booking Status</button>
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
