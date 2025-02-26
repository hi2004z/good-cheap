<!DOCTYPE html>

<!-- =========================================================
* OneDream Dashboard | v1.0.0
==============================================================

* Product Page: https://OneDream.com/products/sneat-bootstrap-html-admin-template/
* Created by: OneDream
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright OneDream (https://OneDream.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Register Basic - Pages | OneDream Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset("/../admin/assets/img/favicon/favicon.ico") }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset("/../admin/assets/vendor/fonts/boxicons.css") }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset("/../admin/assets/vendor/css/core.css") }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset("/../admin/assets/vendor/css/theme-default.css") }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset("/../admin/assets/css/demo.css") }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset("/../admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css") }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset("/../admin/assets/vendor/css/pages/page-auth.css") }}" />
    <!-- Helpers -->
    <script src="{{ asset("/../admin/assets/vendor/js/helpers.js") }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset("/../admin/assets/js/config.js") }}"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ url("/") }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('assets/images/demos/demo-4/logo.png') }}" alt="Molla Logo" width="150">
                                </span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Forgot Password? 🔒</h4>
                        <p class="mb-2">Enter your email and we'll send you instructions to reset your password</p>
                        <x-auth-session-status class="mb-2 d-block fw-bold text-heading text-dark" :status="session('status')" />
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <x-input-label for="email" :value="__('Email')" />
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    :value="old('email')" required autofocus
                                    autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />

                            </div>
                            <!-- <button class="btn btn-primary d-grid w-100">Send Reset Link</button> -->

                            <x-primary-button class="btn btn-primary d-grid w-100 mb-3">
                                {{ __('Email Password Reset Link') }}
                            </x-primary-button>

                        </form>
                        <div class="text-center">
                            <a href="{{ url("login") }}" class="d-flex align-items-center justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                Back to login
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>

    <!-- / Content -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset("/../admin/assets/vendor/libs/jquery/jquery.js") }}"></script>
    <script src="{{ asset("/../admin/assets/vendor/libs/popper/popper.js") }}"></script>
    <script src="{{ asset("/../admin/assets/vendor/js/bootstrap.js") }}"></script>
    <script src="{{ asset("/../admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js") }}"></script>

    <script src="{{ asset("/../admin/assets/vendor/js/menu.js") }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset("/../admin/assets/js/main.js") }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>