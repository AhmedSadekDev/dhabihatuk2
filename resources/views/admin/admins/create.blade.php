@extends('layouts.master')
@section('title')
    {{ __('admin.addAdmin') }}
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
            {{ __('admin.addAdmin') }}
        @endslot
        @slot('title')
            {{ __('admin.addAdmin') }}
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-0">{{ __('admin.addAdmin') }}</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('admins.store') }}" method="POST">
                        @csrf
                        @include('layouts.session')
                        @component('components.errors')
                            @slot('id')
                                permissions
                            @endslot
                        @endcomponent
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-switch">
                                        <input type="checkbox" name="verified"
                                            class="form-control d-none @error('verified') is-invalid @enderror" />
                                        <div class="main-toggle main-toggle-success" style="cursor: pointer">
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
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="name">{{ __('admin.name') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="input" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="{{ __('admin.name') }}"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="email">{{ __('admin.email') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="{{ __('admin.email') }}"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="phone">{{ __('admin.phone') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" placeholder="{{ __('admin.phone') }}"
                                        value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="password">{{ __('admin.password') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="{{ __('admin.password') }}"
                                        value="{{ old('password') }}" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-primary mt-4" type="submit">{{ __('admin.addAdmin') }}</button>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
@section('js')
    <script>
        function handleClick(cb) {
            if (cb.checked) {
                var checked = document.getElementsByClassName("checkbox");
                for (let i = 0; i < checked.length; i++) {
                    checked[i].checked = true;
                }
                var classes = document.getElementsByClassName("main-toggle");
                for (let index = 0; index < classes.length; index++) {
                    classes[index].classList.add("on");
                }
            } else {
                var checked = document.getElementsByClassName("checkbox");
                for (let i = 0; i < checked.length; i++) {
                    checked[i].checked = false;
                }
                var classes = document.getElementsByClassName("main-toggle");
                for (let index = 0; index < classes.length; index++) {
                    classes[index].classList.remove("on");
                }
            }
        } <
        !--Internal Datepicker js-- >
    </script>
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
    <!-- Internal ckeditor js -->
    <script src="{{ URL::asset('assets/libs/@ckeditor/@ckeditor.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/ckeditor.js') }}"></script>
@endsection
