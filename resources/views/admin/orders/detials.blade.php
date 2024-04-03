@extends('layouts.master')
@section('title')
    {{ __('admin.ordereDetials') }}
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
            {{ __('admin.ordereDetials') }}
        @endslot
        @slot('title')
            {{ __('admin.ordereDetials') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0">
                        {{ __('admin.ordereDetials') }} #{{ $order->random_code }}
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
                                <th class="fw-bold">{{ __('admin.image') }}</th>
                                <th class="fw-bold">{{ __('admin.name') }}</th>
                                <th class="fw-bold">{{ __('admin.Chopping') }}</th>
                                <th class="fw-bold">{{ __('admin.Wrapping') }}</th>
                                <th class="fw-bold">{{ __('admin.count') }}</th>
                                <th class="fw-bold">{{ __('admin.total') }}</th>
                                <th class="fw-bold">{{ __('admin.notes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->details as $count => $product)
                                <tr data-id="{{ $count + 1 }}">
                                    <td style="width: 80px" class="align-middle">{{ $count + 1 }}</td>
                                    <td class="align-middle"><img
                                            src="{{ asset('Admin/images/products/' . $product->product->images[0]->image) }}"
                                            alt="{{ __('admin.image') }}" style="width: 100px;" /></td>
                                    <td class="align-middle">{{ $product->product->title() }}</td>
                                    <td class="align-middle">{{ $product->chopping->title() }}</td>
                                    <td class="align-middle">{{ $product->wrapping->title() }}</td>
                                    <td class="align-middle">{{ $product->count }}</td>
                                    <td class="align-middle">{{ $product->total }}</td>
                                    <td class="align-middle">{{ $product->notes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0">
                        {{ __('admin.delivaryDetials') }}
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
                                <th class="fw-bold">{{ __('admin.address') }}</th>
                                <th class="fw-bold">{{ __('admin.lat') }}</th>
                                <th class="fw-bold">{{ __('admin.long') }}</th>
                                <th class="fw-bold">{{ __('admin.time') }}</th>
                                <th class="fw-bold">{{ __('admin.date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-id="{{ $count + 1 }}">
                                <td style="width: 80px" class="align-middle">{{ $count + 1 }}</td>
                                <td class="align-middle">{{ $order->address }}</td>
                                <td class="align-middle">{{ $order->lat }}</td>
                                <td class="align-middle">{{ $order->long }}</td>
                                <td class="align-middle">{{ $order->time }}</td>
                                <td class="align-middle">{{ $order->date }}</td>
                            </tr>
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
