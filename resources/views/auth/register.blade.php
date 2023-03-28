<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LT-Booking Login </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    {{-- <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png"> --}}
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="font/flaticon.css">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
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
    <section class="fxt-template-animation fxt-template-layout9" data-bg-image="img/figure/bg9-l.jpg">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-3">
                    <div class="fxt-header">
                        <a href="{{ route('login') }}" class="fxt-logo"><img src="img/logo-9.svg" alt="Logo"></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fxt-content">
                        <h2>Register for new account</h2>
                        <div class="fxt-form">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                                        <input type="text" id="name"
                                            class="form-control  @error('email') is-invalid @enderror" name="name"
                                            placeholder="Name" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                                        <input type="email" id="email"
                                            class="form-control  @error('email') is-invalid @enderror" name="email"
                                            placeholder="Email" value="{{ old('email') }}" required
                                            autocomplete="email" autofocus>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-3">
                                        <input id="password" type="password"
                                            class=" toggle_pw form-control @error('password') is-invalid @enderror "
                                            name="password" placeholder="********" required
                                            autocomplete="current-password">
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

                                @if (Route::has('password.request'))
                                    <div class="form-group">
                                        <div class="fxt-transformY-50 fxt-transition-delay-4">
                                            <div class="fxt-checkbox-area">
                                                <div class="checkbox d-flex">
                                                    <input type="checkbox" class="login-checkbox" id="remember"
                                                        {{ old('remember') ? 'checked' : '' }} name="remember">
                                                    <label for="checkbox1">Keep me logged in</label>
                                                </div>
                                                <a href="{{ route('password.request') }}" class="switcher-text">Forgot
                                                    Password</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-5">
                                        <button type="submit" class="fxt-btn-fill">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="fxt-footer">
                            <div class="fxt-transformY-50 fxt-transition-delay-6">
                                <p>Already have an account?<a href="{{ route('login') }}"
                                        class="switcher-text2 inline-text">Log in</a></p>
										<a href="{{ route('google.login') }}" class="login-with-google-btn">
											Log in with Google
										</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jquery-->
    <script src="js/jquery-3.5.0.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Imagesloaded js -->
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <!-- Validator js -->
    <script src="js/validator.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>

</body>

</html>
