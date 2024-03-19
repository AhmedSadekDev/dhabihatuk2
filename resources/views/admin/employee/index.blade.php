<?php
if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
    $search = '';
}
?>
@extends('layouts.master')
@section('title')
    {{ __('admin.employees') }}
@endsection
@section('css')
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <style>
        .pagination-box {
            display: flex;
            justify-content: flex-end;
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('admin.employees') }}
        @endslot
        @slot('title')
            {{ __('admin.employees') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0">{{ __('admin.employees') }}</h4>
                    @can('addEmployee')
                        <a href="{{ route('addEmployee') }}" class="btn btn-primary button-icon"><i
                                class="fe fe-plus ml-2 font-weight-bolder"></i>{{ __('admin.add_employee') }}</a>
                    @endcan

                </div>
                <div class="card-body table-responsive border-0">
                    @include('layouts.session')
                    @component('components.errors')
                        @slot('id')
                            admin_id
                        @endslot
                    @endcomponent
                    <form class="needs-validation" action="{{ route('searchEmployee') }}" method="get">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control @error('search') is-invalid @enderror"
                                        id="search" name="search" placeholder="{{ __('admin.searchEmployee') }}"
                                        value="{{ $search }}" required>
                                    @error('search')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary mb-3" type="submit">{{ __('admin.search') }}</button>
                        </div>

                    </form>
                    <br>
                    <table id="datatable" class="table table-bordered dt-responsive text-nowrap w-100">
                        <thead>
                            <tr style="cursor: pointer;">
                                <th class="fw-bold">#</th>
                                <th class="fw-bold">{{ __('admin.name') }}</th>
                                <th class="fw-bold">{{ __('admin.email') }}</th>
                                <th class="fw-bold">{{ __('admin.phone') }}</th>
                                <th class="fw-bold">{{ __('admin.statusAccount') }}</th>
                                <th class="fw-bold">{{ __('admin.dateRegister') }}</th>
                                <th class="fw-bold">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) == 0)
                                <tr class="align-middle">
                                    <td colspan="6" class="text-center">{{ __('admin.no_data') }}</td>
                                </tr>
                            @endif
                            @foreach ($users as $count => $user)
                                <tr data-id="{{ $count + 1 }}">
                                    <td style="width: 80px" class="align-middle">{{ $count + 1 }}</td>
                                    <td class="align-middle">{{ $user->name }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">{{ $user->phone }}</td>
                                    <td class="align-middle">
                                        {{ $user->status == 0 ? __('admin.non-verified') : __('admin.verified') }}</td>
                                    <td class="align-middle">{{ $user->created_at }}
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex">
                                            @can('editEmployee')
                                                <form class="d-inline ml-2" action="{{ route('employee.verify') }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="admin_id" value="{{ $user->id }}" />
                                                    <button type="submit"
                                                        class="btn btn-outline-secondary  bg-primary text-dark btn-sm"
                                                        @if ($user->status == 1) title="{{ __('admin.notactive') }}" @else title="{{ __('admin.active') }}" @endif>
                                                        <i class="@if ($user->status == 1) fas fa-eye-slash @else fas fa-eye @endif"
                                                            style="color:white"></i>
                                                    </button>
                                                </form>
                                                <a class="btn btn-outline-secondary bg-warning text-dark btn-sm ml-2"
                                                    title="{{ __('admin.edit') }}"
                                                    href="{{ route('employee.edit', [$user->id]) }}">
                                                    <i class="fas fa-pencil-alt" style="color:white"></i>
                                                </a>
                                            @endcan
                                            @can('deleteEmployee')
                                                <button type="submit"
                                                    class="modal-effect btn btn-outline-secondary bg-danger text-dark btn-sm"
                                                    title="{{ __('admin.delete') }}" data-effect="effect-newspaper"
                                                    data-toggle="modal" href="#myModal{{ $user->id }}">
                                                    <i class="fas fa-trash-alt" style="color:white"></i>
                                                </button>
                                            @endcan
                                        </div>

                                        @can('deleteEmployee')
                                            <div class="modal" id="myModal{{ $user->id }}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content modal-content-demo">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ __('admin.deleteEmployee') }}</h5>
                                                            <button aria-label="Close" class="close" data-dismiss="modal"
                                                                type="button"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ __('admin.deleteEmployeeMessage') }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form class="d-inline" action="{{ route('employee.delete') }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('Delete')
                                                                <input type="hidden" name="admin_id"
                                                                    value="{{ $user->id }}" />
                                                                <button type="button" class="btn btn-secondary waves-effect"
                                                                    data-dismiss="modal">{{ __('admin.back') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger waves-effect waves-light">{{ __('admin.delete') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 pagination-box">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
@endsection
