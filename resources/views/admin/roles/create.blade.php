@extends('layouts.master')
@section('title')
    {{ __('admin.addRole') }}
@endsection
@section('css')
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('admin.addRole') }}
        @endslot
        @slot('title')
            {{ __('admin.addRole') }}
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-0">{{ __('admin.addRole') }}</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('role.store') }}" method="POST">
                        @csrf
                        @include('layouts.session')
                        @component('components.errors')
                            @slot('id')
                                permissions
                            @endslot
                        @endcomponent

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="name_ar">{{ __('admin.name_ar') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="input" class="form-control @error('name_ar') is-invalid @enderror"
                                        id="name_ar" name="name" placeholder="{{ __('admin.name_ar') }}"
                                        value="{{ old('name_ar') }}" required>
                                    @error('name_ar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="name_en">{{ __('admin.name_en') }} <span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="input" class="form-control @error('name_en') is-invalid @enderror"
                                        id="name_en" name="name_en" placeholder="{{ __('admin.name_en') }}"
                                        value="{{ old('name_en') }}" required>
                                    @error('name_en')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive col-12">
                                <label class="form-label" for="permissions">{{ __('admin.roles') }} <span
                                        class="text-danger fw-bolder">*</span>
                                    <span>{{ __('admin.checkall') }}</span>
                                    <input type="checkbox" onclick="handleClick(this);">
                                </label>
                                <table class="table table-bordered table-striped table-nowrap mb-0">
                                    <tbody>
                                        @foreach ($permissions as $key => $permission)
                                            <tr>
                                                <th class="text-nowrap col-1 fw-bold" scope="row">
                                                    <label class="form-switch d-flex m-0">
                                                        <input type="checkbox" name="permissions[]"
                                                            class="form-control d-none checkbox"
                                                            value="{{ $key }}" />
                                                        <div class="main-toggle main-toggle-success"
                                                            style="cursor: pointer">
                                                            <span data-on-label="{{ __('admin.yes') }}"
                                                                data-off-label="{{ __('admin.no') }}"></span>
                                                        </div>
                                                    </label>
                                                </th>
                                                <td class="align-middle">{{ $permission }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-4" type="submit">{{ __('admin.addRole') }}</button>
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
        }
    </script>
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
