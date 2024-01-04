<!DOCTYPE html>
<html lang="en">

<head>
    <title>LOGIN | SI-ITIK</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('admin/assets/img/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('loginpage/assets/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('loginpage/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('loginpage/assets/vendor/animate/animate.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('loginpage/assets/vendor/css-hamburgers/hamburgers.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('loginpage/assets/vendor/select2/select2.min.css') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('loginpage/assets/css/util.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('loginpage/assets/css/main.css') }}" />
    <script src={{ asset('admin/assets/js/sweetalert2@10.js') }}></script>
    <!--===============================================================================================-->
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                @if ($errors->any())
                    <div class="mb-3">
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Oops...',
                                    icon: 'error', // Ganti dengan emotikon atau emoji yang Anda inginkan
                                    html: '<ul class="list-disc">' +
                                        @foreach ($errors->all() as $error)
                                            '<li>{{ $error }}</li>' +
                                        @endforeach
                                    '</ul>',
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        popup: 'text-center', // Tambahkan styling untuk pusatkan teks
                                    },
                                });
                            });
                        </script>
                    </div>
                @endif

                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('loginpage/assets/images/infratek.png') }}" alt="IMG" />
                </div>

                <form action="" method="POST" class="login100-form validate-form">
                    @csrf
                    <span class="login100-form-title">
                        LOGIN APLIKASI
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" id="password" placeholder="Email"
                            value="{{ old('email') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" id="password" placeholder="Password" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button name="submit" type="submit" class="login100-form-btn">Login</button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">Milik Infratek Diskominfo Kab. Subang</span>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="#"> #SATUKAN NEGERI </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="{{ asset('loginpage/assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('loginpage/assets/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('loginpage/assets/vendor/bootstrap/js/bootstrap.min.js"') }}></script>
    <!--===============================================================================================-->
    <script src="{{ asset('loginpage/assets/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('loginpage/assets/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $(".js-tilt").tilt({
            scale: 1.1,
        });
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('loginpage/assetsjs/main.js') }}"></script>
    <script disable-devtool-auto src='{{ asset('admin/assets/js/protected.js') }}'></script>
</body>

</html>
