@extends('layouts.master')
@section('title')
    {{ __('admin.roles') }}
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
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('admin.roles') }}
        @endslot
        @slot('title')
            {{ __('admin.roles') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0"> {{ __('admin.roles') }} </h4>
                    @can('addRole')
                        <a href="{{ route('addRole') }}" class="btn btn-primary button-icon"><i
                                class="fe fe-plus ml-2 font-weight-bolder"></i>{{ __('admin.addRole') }}</a>
                    @endcan
                </div>
                <div class="card-body table-responsive border-0">
                    @include('layouts.session')
                    @component('components.errors')
                        @slot('id')
                            admin_id
                        @endslot
                    @endcomponent
                    <table id="datatable" class="table table-bordered dt-responsive text-nowrap w-100">
                        <thead>
                            <tr style="cursor: pointer;">
                                <th class="fw-bold">#</th>
                                <th class="fw-bold">{{ __('admin.name') }}</th>
                                <th class="fw-bold" style="min-width: 300px">{{ __('admin.roles') }}</th>
                                <th class="fw-bold">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($roles) == 0)
                                <tr class="align-middle">
                                    <td colspan="6" class="text-center">{{ __('admin.no_data') }}</td>
                                </tr>
                            @endif
                            @foreach ($roles as $count => $role)
                                <tr data-id="{{ $count + 1 }}">
                                    <td style="width: 80px" class="align-middle">{{ $count + 1 }}</td>
                                    <td class="align-middle">{{ $role->getName() }}</td>
                                    <td style="white-space: normal;">

                                        @foreach ($role->permissionsRoles() as $roles)
                                            {{ $roles }},
                                        @endforeach
                                    </td>

                                    <td class="align-middle">
                                        <div class="d-flex">
                                            @if ($role->id != 1)
                                                @can('editRole')
                                                    <a class="btn btn-outline-secondary bg-warning text-dark btn-sm ml-2"
                                                        title="{{ __('admin.edit') }}"
                                                        href="{{ route('role.edit', [$role->id]) }}">
                                                        <i class="fas fa-pencil-alt" style="color:white"></i>
                                                    </a>
                                                @endcan
                                            @endif
                                            @if ($role->id != 1 && $role->id != 2 && $role->id != 3)
                                                @can('deleteRole')
                                                    <button type="submit"
                                                        class="modal-effect btn btn-outline-secondary bg-danger text-dark btn-sm"
                                                        title="{{ __('admin.delete') }}" data-effect="effect-newspaper"
                                                        data-toggle="modal" href="#myModal{{ $role->id }}">
                                                        <i class="fas fa-trash-alt" style="color:white"></i>
                                                    </button>
                                                @endcan
                                            @endif
                                            @if ($role->id == 1)
                                                {{ __('admin.not_change') }}
                                            @endif

                                        </div>

                                        @can('deleteRole')
                                            <div class="modal" id="myModal{{ $role->id }}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content modal-content-demo">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ __('admin.deleteRole') }}</h5>
                                                            <button aria-label="Close" class="close" data-dismiss="modal"
                                                                type="button"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ __('admin.delete_role') }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form class="d-inline" action="{{ route('role.delete') }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('Delete')
                                                                <input type="hidden" name="admin_id"
                                                                    value="{{ $role->id }}" />
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
