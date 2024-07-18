<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}" sizes="16x16">
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

<section class="auth bg-base d-flex flex-wrap">
    <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="{{ asset('assets/images/auth/auth-img.png') }}" alt="">
        </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                <a href="javascript:void(0)" class="mb-40 max-w-290-px">
                    <img src="{{ asset('logo.png') }}" alt="">
                </a>
                <h4 class="mb-12">Login Dengan Akun SSO Anda</h4>
            </div>
                <div class="mt-32 d-flex align-items-center gap-3">
                    <a href="{{ route('auth.keycloak.login') }}" class="btn btn-sm btm-info"><button type="button" class="fw-semibold text-primary-light py-16 px-24 w-50 border radius-12 text-md d-flex align-items-center justify-content-center gap-12 line-height-1 bg-hover-primary-50">
                        <iconify-icon icon="ion:key-outline" class="text-primary-600 text-xl line-height-1"></iconify-icon>
                        SSO UNIMED
                    </button>
                    </a>
                </div>

        </div>
    </div>
</section>

<!-- jQuery library js -->
<script src="{{ asset('assets/js/lib/jquery-3.7.1.min.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/iconify-icon.min.js') }}"></script>

<!-- main js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

</script>

</body>

</html>
