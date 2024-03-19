@extends('layouts.master')
@section('title')
    {{ __('admin.main') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ __('admin.General_analyses') }}</h2>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <div class="row row-sm">
        @can('admins')
            <div class="col-lg-6 col-xl-4 col-12">
                <a href="{{ route('admins') }}">
                    <div class="card bg-primary-gradient text-white ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mt-0 text-center">
                                        <span class="text-white">{{ __('admin.count_admins') }}</span>
                                        <h2 class="text-white mb-0">{{ $admins }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('employee')
            <div class="col-lg-6 col-xl-4 col-12">
                <a href="{{ route('employee') }}">
                    <div class="card bg-primary-gradient text-white ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mt-0 text-center">
                                        <span class="text-white">{{ __('admin.count_Employee') }}</span>
                                        <h2 class="text-white mb-0">{{ $employees }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
        @can('contact')
            <div class="col-lg-6 col-xl-4 col-12">
                <a href="{{ route('contact') }}">
                    <div class="card bg-primary-gradient text-white ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mt-0 text-center">
                                        <span class="text-white">{{ __('admin.count_contact') }}</span>
                                        <h2 class="text-white mb-0">{{ $contact }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endcan

    </div>
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
@endsection
