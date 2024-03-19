@extends('layouts.master2')
@section('title')
    تسجيل دخول
@endsection
@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{ env('APP_URL').'assets/img/media/login.png' }}"
                            class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex"> <a href="{{ url('/' . ($page = 'index')) }}"><img
                                                src="{{ asset('Admin/images/setting/'.$setting->logo) }}"
                                                class="sign-favicon ht-40" alt="logo"></a>
                                        <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">{{ $setting->name_ar }}</h1>
                                    </div>
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2>مرحبا بعودتك!</h2>
                                            <h5 class="font-weight-semibold mb-4">من فضلك سجل دخولك للمتابعة.</h5>
                                            <form action="{{ route('signIn') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label>البريد الالكتروني</label> <input
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        placeholder="ادخل البريد الالكتروني" type="text" name="email">
                                                </div>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="form-group">
                                                    <label>كلمة السر</label> <input
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        placeholder="ادخل كلمة السر" type="password" name="password">
                                                </div><button class="btn btn-main-primary btn-block">تسجيل دخول</button>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>
@endsection
@section('js')
@endsection
