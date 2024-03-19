@extends('layouts.master')
@section('title')
    @if ($status == 0)
        {{ __('admin.new_suitable') }}
    @elseif($status == 1)
        {{ __('admin.accepet_suitable') }}
    @else
        {{ __('admin.rejecet_suitable') }}
    @endif
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
            @if ($status == 0)
                {{ __('admin.new_suitable') }}
            @elseif($status == 1)
                {{ __('admin.accepet_suitable') }}
            @else
                {{ __('admin.rejecet_suitable') }}
            @endif
        @endslot
        @slot('title')
            @if ($status == 0)
                {{ __('admin.new_suitable') }}
            @elseif($status == 1)
                {{ __('admin.accepet_suitable') }}
            @else
                {{ __('admin.rejecet_suitable') }}
            @endif
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0">
                        @if ($status == 0)
                            {{ __('admin.new_suitable') }}
                        @elseif($status == 1)
                            {{ __('admin.accepet_suitable') }}
                        @else
                            {{ __('admin.rejecet_suitable') }}
                        @endif
                    </h4>
                    @if ($status == 0)
                        @can('addSuitable')
                            <a href="{{ route('addSuitable') }}" class="btn btn-primary button-icon"><i
                                    class="fe fe-plus ml-2 font-weight-bolder"></i>{{ __('admin.addSuitable') }}</a>
                        @endcan
                    @endif

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
                                <th class="fw-bold">{{ __('admin.image') }}</th>
                                <th class="fw-bold">{{ __('admin.title') }}</th>
                                <th class="fw-bold">{{ __('admin.description') }}</th>
                                <th class="fw-bold">{{ __('admin.suitableUser') }}</th>
                                <th class="fw-bold">{{ __('admin.address') }}</th>
                                <th class="fw-bold">{{ __('admin.time') }}</th>
                                <th class="fw-bold">{{ __('admin.date_suitable') }}</th>
                                <th class="fw-bold">{{ __('admin.status') }}</th>
                                @can('accepetOrRejecetSuitable')
                                    <th class="fw-bold">{{ __('admin.accepetOrRejecet') }}</th>
                                @endcan
                                <th class="fw-bold">{{ __('admin.created_at') }}</th>
                                <th class="fw-bold">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($suitables) == 0)
                                <tr class="align-middle">
                                    <td colspan="12" class="text-center">{{ __('admin.no_data') }}</td>
                                </tr>
                            @endif
                            @foreach ($suitables as $count => $suitable)
                                <tr data-id="{{ $count + 1 }}">
                                    <td style="width: 80px" class="align-middle">{{ $count + 1 }}</td>
                                    <td class="align-middle"><img
                                            src="{{ asset('Admin/images/suitables/' . $suitable->image) }}"
                                            alt="{{ __('admin.image') }}" style="width: 100px;" /></td>
                                    <td class="align-middle">{{ $suitable->title() }}</td>
                                    <td class="align-middle">{!! mb_strimwidth($suitable->desc(), 0, 500, ',...') !!}</td>
                                    <td class="align-middle">{{ $suitable->user->name }}</td>
                                    <td class="align-middle">{{ $suitable->address }}</td>
                                    <td class="align-middle">{{ $suitable->time() }}</td>
                                    <td class="align-middle">{{ $suitable->date }}</td>
                                    <td class="align-middle">
                                        {{ $suitable->show == 0 ? __('admin.hidden') : __('admin.displayed') }}</td>
                                    @can('accepetOrRejecetSuitable')
                                        <td class="align-middle">
                                            @if ($status == 0)
                                                <a href="{{ route('suitables.accepet', $suitable->id) }}"
                                                    class="btn btn-success">{{ __('admin.accepet') }}</a>
                                                <a href="{{ route('suitables.rejecet', $suitable->id) }}"
                                                    class="btn btn-danger">{{ __('admin.rejecet') }}</a>
                                            @elseif($status == 1)
                                                {{ __('admin.accepet') }}
                                            @else
                                                {{ __('admin.rejecet') }}
                                            @endif
                                        </td>
                                    @endcan
                                    <td class="align-middle">{{ $suitable->created_at }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex">
                                            @can('editsuitable')
                                                <form class="d-inline ml-2" action="{{ route('suitables.verify') }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="suitable_id" value="{{ $suitable->id }}" />
                                                    <button type="submit"
                                                        class="btn btn-outline-secondary  bg-primary text-dark btn-sm"
                                                        @if ($suitable->show == 1) title="{{ __('admin.hide') }}" @else title="{{ __('admin.showIcon') }}" @endif>
                                                        <i class="@if ($suitable->show == 1) fas fa-eye-slash @else fas fa-eye @endif"
                                                            style="color:white"></i>
                                                    </button>
                                                </form>

                                                <a class="btn btn-outline-secondary bg-warning text-dark btn-sm ml-2"
                                                    title="{{ __('admin.edit') }}"
                                                    href="{{ route('suitables.edit', [$suitable->id]) }}">
                                                    <i class="fas fa-pencil-alt" style="color:white"></i>
                                                </a>
                                            @endcan
                                            @can('deleteNew')
                                                <button type="submit"
                                                    class="modal-effect btn btn-outline-secondary bg-danger text-dark btn-sm"
                                                    title="{{ __('admin.delete') }}" data-effect="effect-newspaper"
                                                    data-toggle="modal" href="#myModal{{ $suitable->id }}">
                                                    <i class="fas fa-trash-alt" style="color:white"></i>
                                                </button>
                                            @endcan


                                        </div>

                                        @can('deleteSuitable')
                                            <div class="modal" id="myModal{{ $suitable->id }}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content modal-content-demo">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ __('admin.deleteSuitable') }}</h5>
                                                            <button aria-label="Close" class="close" data-dismiss="modal"
                                                                type="button"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ __('admin.deleteSuitableMessage') }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form class="d-inline" action="{{ route('suitables.delete') }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('Delete')
                                                                <input type="hidden" name="new_id"
                                                                    value="{{ $suitable->id }}" />
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
                            {{ $suitables->links() }}
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
