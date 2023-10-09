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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('font/flaticon.css') }}">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
</head>
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

<body>
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
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-3">
                    <div class="fxt-header">
                        <a href="login-9.html" class="fxt-logo"><img src="{{ asset('img/logo-9.svg') }}"
                                alt="Logo"></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fxt-content">
                        <h2>Create new passsword</h2>
                        @if (session('errors'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach (session('errors')->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="fxt-form">
                            <form method="POST" action="{{ route('password.change.post') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-3">
                                        <input id="password" type="password"
                                            class=" toggle_pw form-control @error('password') is-invalid @enderror "
                                            name="password" placeholder="New Password" required
                                            autocomplete="">
                                        {{-- <i toggle=".toggle_pw" class="fa fa-fw fa-eye toggle-password field-icon"></i> --}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-3">
                                        <input id="password-confirm" type="password"
                                            class=" toggle_pw form-control"name="password_confirmation" required
                                            autocomplete="new-password" placeholder="Confirm Password">
                                        <i toggle=".toggle_pw" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-4">
                                        <button type="submit" class="fxt-btn-fill">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="fxt-footer">
							<div class="fxt-transformY-50 fxt-transition-delay-9">
								<p>Don't have an account?<a href="register-9.html" class="switcher-text2 inline-text">Register</a></p>
							</div>
						</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jquery-->
    <script src="{{ asset('js/jquery-3.5.0.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Imagesloaded js -->
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- Validator js -->
    <script src="{{ asset('js/validator.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
