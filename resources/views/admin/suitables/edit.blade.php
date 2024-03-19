@extends('layouts.master')
@section('title')
    {{ __('admin.editSuitable') }}
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
            {{ __('admin.editSuitable') }}
        @endslot
        @slot('title')
            {{ __('admin.editSuitable') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-0">{{ __('admin.editSuitable') }}</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('suitables.update') }}" method="POST"
                        enctype="multipart/form-data" id="product-form">
                        @csrf
                        @method('put')
                        <input type="hidden" name="suitable_id" value="{{ $suitable->id }}" />
                        @include('layouts.session')
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="image">{{ __('admin.image') }} <span
                                            class="text-danger fw-bolder"></span></label>
                                    <div>
                                        <img src="{{ asset('Admin/images/suitables/' . $suitable->image) }}"
                                            alt="{{ __('admin.icon') }}" class="img-thumbnail wd-100p wd-sm-200" />
                                    </div>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image">
                                    @error('image')
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
                                    <label class="form-label" for="name_ar">{{ __('admin.name_ar') }} <span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                                        id="name_ar" name="name_ar" placeholder="{{ __('admin.name_ar') }}"
                                        value="{{ $suitable->name_ar }}" required>
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
                                    <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                                        id="name_en" name="name_en" placeholder="{{ __('admin.name_en') }}"
                                        value="{{ $suitable->name_en }}" required>
                                    @error('name_en')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="date">{{ __('admin.date_suitable') }} <span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                                        id="date" name="date" placeholder="{{ __('admin.date_suitable') }}"
                                        value="{{ $suitable->date }}" required>
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="time">{{ __('admin.time') }} <span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="time" class="form-control @error('time') is-invalid @enderror"
                                        id="time" name="time" placeholder="{{ __('admin.time') }}"
                                        value="{{ $suitable->time }}" required>
                                    @error('time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="lat">{{ __('admin.lat') }} <span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="text" class="form-control @error('lat') is-invalid @enderror"
                                        id="lat" name="lat" placeholder="{{ __('admin.lat') }}"
                                        value="{{ $suitable->lat }}" required>
                                    @error('lat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="long">{{ __('admin.long') }} <span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="text" class="form-control @error('long') is-invalid @enderror"
                                        id="long" name="long" placeholder="{{ __('admin.long') }}"
                                        value="{{ $suitable->long }}" required>
                                    @error('long')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="address">{{ __('admin.address') }} <span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" placeholder="{{ __('admin.address') }}"
                                        value="{{ $suitable->address }}" required>
                                    @error('address')
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
                                    <label class="form-label" for="desc">{{ __('admin.desc_ar') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <textarea class="form-control @error('desc_ar') is-invalid @enderror" id="description" name="desc_ar"
                                        placeholder="{{ __('admin.desc_ar') }}">{{ $suitable->desc_ar }}</textarea>
                                    @error('desc_ar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="desc">{{ __('admin.desc_en') }}<span
                                            class="text-danger fw-bolder">*</span></label>
                                    <textarea class="form-control @error('desc_en') is-invalid @enderror" id="description_en" name="desc_en"
                                        placeholder="{{ __('admin.desc_en') }}">{{ $suitable->desc_en }}</textarea>
                                    @error('desc_en')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <button class="btn btn-primary" type="submit">{{ __('admin.editSuitable') }}</button>
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
    <!-- Internal ckeditor js -->
    <script src="{{ URL::asset('assets/libs/@ckeditor/@ckeditor.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/ckeditor.js') }}"></script>
    <!-- Handle Product Details -->
    <script src="{{ URL::asset('assets/js/product.details.js') }}"></script>
@endsection
