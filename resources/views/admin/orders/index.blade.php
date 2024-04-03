@extends('layouts.master')
@section('title')
    {{ __('admin.orders') }}
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
            {{ __('admin.orders') }}
        @endslot
        @slot('title')
            {{ __('admin.orders') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0">
                        {{ __('admin.orders') }}
                    </h4>

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
                                <th class="fw-bold">{{ __('admin.code') }}</th>
                                <th class="fw-bold">{{ __('admin.name') }}</th>
                                <th class="fw-bold">{{ __('admin.email') }}</th>
                                <th class="fw-bold">{{ __('admin.phone') }}</th>
                                <th class="fw-bold">{{ __('admin.address') }}</th>
                                <th class="fw-bold">{{ __('admin.delivary') }}</th>
                                <th class="fw-bold">{{ __('admin.addition') }}</th>
                                <th class="fw-bold">{{ __('admin.total') }}</th>
                                <th class="fw-bold">{{ __('admin.status') }}</th>
                                @can('changeStatus')
                                    <th class="fw-bold">{{ __('admin.actions') }}</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($orders) == 0)
                                <tr class="align-middle">
                                    <td colspan="11" class="text-center">{{ __('admin.no_data') }}</td>
                                </tr>
                            @endif
                            @foreach ($orders as $count => $order)
                                <tr data-id="{{ $count + 1 }}">
                                    <td style="width: 80px" class="align-middle">{{ $count + 1 }}</td>
                                    <td class="align-middle"><a
                                            href="{{ route('orders.detials', $order->id) }}">{{ $order->random_code }}</a>
                                    </td>
                                    <td class="align-middle">{{ $order->user->name }}</td>
                                    <td class="align-middle">{{ $order->user->email }}</td>
                                    <td class="align-middle">{{ $order->user->phone }}</td>
                                    <td class="align-middle">{{ $order->address }}</td>
                                    <td class="align-middle">{{ $order->delivary }}</td>
                                    <td class="align-middle">{{ $order->addition }}</td>
                                    <td class="align-middle">{{ $order->total }}</td>
                                    <td class="align-middle">{{ $order->getStatus() }}</td>

                                    <td class="align-middle">
                                        <div class="d-flex">
                                            @can('changeStatus')
                                                <a class="btn btn-outline-secondary bg-warning text-dark btn-sm ml-2"
                                                    title="{{ __('admin.changeStatus') }}" data-effect="effect-newspaper"
                                                    data-toggle="modal" href="#changeStatus{{ $order->id }}">
                                                    <i class="fas fa-pencil-alt" style="color:white"></i>
                                                </a>
                                            @endcan
                                            @if ($order->status == 1)
                                                @can('deleteOrder')
                                                    <button type="submit"
                                                        class="modal-effect btn btn-outline-secondary bg-danger text-dark btn-sm"
                                                        title="{{ __('admin.cancel') }}" data-effect="effect-newspaper"
                                                        data-toggle="modal" href="#myModal{{ $order->id }}">
                                                        <i class="fas fa-trash-alt" style="color:white"></i>
                                                    </button>
                                                @endcan
                                            @endif


                                        </div>

                                        @can('deleteOrder')
                                            <div class="modal" id="myModal{{ $order->id }}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content modal-content-demo">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ __('admin.deleteOrder') }}</h5>
                                                            <button aria-label="Close" class="close" data-dismiss="modal"
                                                                type="button"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="desc">{{ __('admin.deleteReason') }}<span
                                                                                class="text-danger fw-bolder">*</span></label>
                                                                        <textarea form="formDelete{{ $order->id }}" class="form-control @error('desc_ar') is-invalid @enderror" required
                                                                            name="desc_ar" placeholder="{{ __('admin.deleteReason') }}">{{ old('desc_ar') }}</textarea>
                                                                        @error('desc_ar')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form id="formDelete{{ $order->id }}" class="d-inline"
                                                                action="{{ route('orders.cancel') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="order_id"
                                                                    value="{{ $order->id }}" />
                                                                <button type="button" class="btn btn-secondary waves-effect"
                                                                    data-dismiss="modal">{{ __('admin.back') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger waves-effect waves-light">{{ __('admin.cancel') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                        @can('changeStatus')
                                            <div class="modal" id="changeStatus{{ $order->id }}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content modal-content-demo">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ __('admin.changeStatus') }}</h5>
                                                            <button aria-label="Close" class="close" data-dismiss="modal"
                                                                type="button"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="status">{{ __('admin.status') }}<span
                                                                                class="text-danger fw-bolder">*</span></label>
                                                                        <select form="formStatus{{ $order->id }}"
                                                                            class="form-control form-select @error('status') is-invalid @enderror"
                                                                            id="status" name="status" required>
                                                                            <option value="1"
                                                                                @if ($order->status == 1) selected @endif>
                                                                                {{ __('admin.newOrder') }}
                                                                            </option>
                                                                            <option value="2"
                                                                                @if ($order->status == 2) selected @endif>
                                                                                {{ __('admin.delivaryOrder') }}
                                                                            </option>
                                                                        </select>
                                                                        @error('status')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form id="formStatus{{ $order->id }}" class="d-inline"
                                                                action="{{ route('orders.changeStatus') }}" method="POST">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="order_id"
                                                                    value="{{ $order->id }}" />
                                                                <button type="button" class="btn btn-secondary waves-effect"
                                                                    data-dismiss="modal">{{ __('admin.back') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger waves-effect waves-light">{{ __('admin.change') }}</button>
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
                            {{ $orders->links() }}
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
