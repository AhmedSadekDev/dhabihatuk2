@extends('layouts.master')
@section('title')
    {{ __('admin.Wrapping') }}
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
            {{ __('admin.Wrapping') }}
        @endslot
        @slot('title')
            {{ __('admin.Wrapping') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0">
                        {{ __('admin.Wrapping') }}
                    </h4>
                    @can('addWrapping')
                        <a href="{{ route('addWrapping') }}" class="btn btn-primary button-icon"><i
                                class="fe fe-plus ml-2 font-weight-bolder"></i>{{ __('admin.addWrapping') }}</a>
                    @endcan

                </div>
                <div class="card-body table-responsive border-0">
                    @include('layouts.session')
                    @component('components.errors')
                        @slot('id')
                            company_id
                        @endslot
                    @endcomponent
                    <table id="datatable" class="table table-bordered dt-responsive text-nowrap w-100">
                        <thead>
                            <tr style="cursor: pointer;">
                                <th class="fw-bold">#</th>
                                <th class="fw-bold">{{ __('admin.title') }}</th>
                                @can('editWrapping')
                                    <th class="fw-bold">{{ __('admin.actions') }}</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($Wrappings) == 0)
                                <tr class="align-middle">
                                    <td colspan="9" class="text-center">{{ __('admin.no_data') }}</td>
                                </tr>
                            @endif
                            @foreach ($Wrappings as $count => $wrapping)
                                <tr data-id="{{ $count + 1 }}">
                                    <td style="width: 80px" class="align-middle">{{ $count + 1 }}</td>
                                    <td class="align-middle">{{ $wrapping->title() }}</td>

                                    <td class="align-middle">
                                        <div class="d-flex">
                                            @can('editWrapping')
                                                <form class="d-inline ml-2" action="{{ route('Wrapping.verify') }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="Wrapping_id" value="{{ $wrapping->id }}" />
                                                    <button type="submit"
                                                        class="btn btn-outline-secondary  bg-primary text-dark btn-sm"
                                                        @if ($wrapping->status == 1) title="{{ __('admin.hide') }}" @else title="{{ __('admin.showIcon') }}" @endif>
                                                        <i class="@if ($wrapping->status == 1) fas fa-eye-slash @else fas fa-eye @endif"
                                                            style="color:white"></i>
                                                    </button>
                                                </form>

                                                <a class="btn btn-outline-secondary bg-warning text-dark btn-sm ml-2"
                                                    title="{{ __('admin.edit') }}"
                                                    href="{{ route('Wrapping.edit', [$wrapping->id]) }}">
                                                    <i class="fas fa-pencil-alt" style="color:white"></i>
                                                </a>
                                            @endcan
                                            @can('deleteWrapping')
                                                <button type="submit"
                                                    class="modal-effect btn btn-outline-secondary bg-danger text-dark btn-sm"
                                                    title="{{ __('admin.delete') }}" data-effect="effect-newspaper"
                                                    data-toggle="modal" href="#myModal{{ $wrapping->id }}">
                                                    <i class="fas fa-trash-alt" style="color:white"></i>
                                                </button>
                                            @endcan


                                        </div>

                                        @can('deleteWrapping')
                                            <div class="modal" id="myModal{{ $wrapping->id }}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content modal-content-demo">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ __('admin.deleteWrapping') }}</h5>
                                                            <button aria-label="Close" class="close" data-dismiss="modal"
                                                                type="button"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ __('admin.deleteWrappingMessage') }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form class="d-inline" action="{{ route('Wrapping.delete') }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('Delete')
                                                                <input type="hidden" name="Wrapping_id"
                                                                    value="{{ $wrapping->id }}" />
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
                            {{ $Wrappings->links() }}
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
