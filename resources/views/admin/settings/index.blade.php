@extends('layouts.master')
@section('title')
    {{ __('admin.settings') }}
@endsection
@section('css')
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('admin.change_settings') }}
        @endslot
        @slot('title')
            {{ __('admin.settings') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-0">{{ __('admin.change_settings') }}</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('setting.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @include('layouts.session')
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="name_ar">{{ __('admin.name_ar') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                                        id="name_ar" name="name_ar" placeholder="{{ __('admin.name_ar') }}"
                                        value="@if ($setting) {{ $setting->name_ar }} @endif" required>
                                    @error('name_ar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="name_en">{{ __('admin.name_en') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                                        id="name_en" name="name_en" placeholder="{{ __('admin.name_en') }}"
                                        value="@if ($setting) {{ $setting->name_en }} @endif" required>
                                    @error('name_en')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="phone">{{ __('admin.phone') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" placeholder="{{ __('admin.phone') }}"
                                        value="@if ($setting) {{ $setting->phone }} @endif" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="email">{{ __('admin.email') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="{{ __('admin.email') }}"
                                        value="@if ($setting) {{ $setting->email }} @endif" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="firebase">{{ __('admin.firebase') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <textarea readonly class="form-control @error('firebase') is-invalid @enderror" id="firebase" name="firebase"
                                        placeholder="{{ __('admin.firebase') }}" required>
@if ($setting)
{{ $setting->firebase }}
@endif
</textarea>
                                    @error('firebase')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="logo">{{ __('admin.logo') }}</label>
                                    @if ($setting)
                                        <div>
                                            <img src="{{ asset('Admin/images/setting/' . $setting->logo) }}"
                                                alt="{{ __('admin.logo') }}" class="img-thumbnail wd-100p wd-sm-200" />
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                        id="logo" name="logo">
                                    @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="ml-3">{{ __('admin.maintenance') }}</span><label class="form-switch">
                                        <input type="checkbox" name="verified"
                                            class="form-control d-none @error('verified') is-invalid @enderror"
                                            {{ $setting->mentanceMode ? 'checked' : '' }} />
                                        <div class="main-toggle main-toggle-success {{ $setting->mentanceMode ? 'on' : '' }}"
                                            style="cursor: pointer">
                                            <span data-on-label="{{ __('admin.success') }}"
                                                data-off-label="{{ __('admin.fail') }}"></span>
                                        </div>
                                    </label>
                                    @error('verified')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label"
                                        for="mentanceMessage">{{ __('admin.mentanceMessage') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <textarea class="form-control @error('mentanceMessage') is-invalid @enderror" id="mentanceMessage"
                                        name="mentanceMessage" placeholder="{{ __('admin.mentanceMessage') }}" required>
@if ($setting)
{{ $setting->mentanceMessage }}
@endif
</textarea>
                                    @error('mentanceMessage')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="verision">{{ __('admin.verision') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="text" class="form-control @error('verision') is-invalid @enderror"
                                        id="verision" name="verision" placeholder="{{ __('admin.verision') }}"
                                        value="@if ($setting) {{ $setting->verision }} @endif"
                                        required>
                                    @error('verision')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="andriod">{{ __('admin.andriod') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="url" class="form-control @error('andriod') is-invalid @enderror"
                                        id="andriod" name="andriod" placeholder="{{ __('admin.andriod') }}"
                                        value="@if ($setting) {{ $setting->andriod }} @endif"
                                        required>
                                    @error('andriod')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="ios">{{ __('admin.ios') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="url" class="form-control @error('ios') is-invalid @enderror"
                                        id="ios" name="ios" placeholder="{{ __('admin.ios') }}"
                                        value="@if ($setting) {{ $setting->ios }} @endif" required>
                                    @error('ios')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="familyImage">{{ __('admin.familyImage') }}</label>
                                    @if ($setting)
                                        <div>
                                            <img src="{{ asset('Admin/images/setting/' . $setting->familyImage) }}"
                                                alt="{{ __('admin.familyImage') }}"
                                                class="img-thumbnail wd-100p wd-sm-200" />
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('familyImage') is-invalid @enderror"
                                        id="familyImage" name="familyImage">
                                    @error('familyImage')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">{{ __('admin.change_settings') }}</button>
                    </form>
                </div>
            </div>


            <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <!-- Ionicons js -->
    <script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
@endsection
