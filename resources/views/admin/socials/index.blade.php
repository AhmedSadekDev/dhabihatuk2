@extends('layouts.master')
@section('title')
    {{ __('admin.socials') }}
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
            {{ __('admin.socials') }}
        @endslot
        @slot('title')
            {{ __('admin.socials') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0">{{ __('admin.socials') }}</h4>
                    <a href="{{ route('socials.create') }}" class="btn btn-primary button-icon"><i
                            class="fe fe-plus ml-2 font-weight-bolder"></i>{{ __('admin.add_social') }}</a>
                </div>
                <div class="card-body table-responsive border-0">
                    @include('layouts.session')
                    @component('components.errors')
                        @slot('id')
                            social_id
                        @endslot
                    @endcomponent
                    <table id="datatable" class="table table-bordered dt-responsive text-nowrap w-100">
                        <thead>
                            <tr style="cursor: pointer;">
                                <th class="fw-bold">#</th>
                                <th class="fw-bold">{{ __('admin.name') }}</th>
                                <th class="fw-bold">{{ __('admin.icon') }}</th>
                                <th class="fw-bold">{{ __('admin.link') }}</th>
                                <th class="fw-bold">{{ __('admin.show') }}</th>
                                <th class="fw-bold">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($socials) == 0)
                                <tr class="align-middle">
                                    <td colspan="6" class="text-center">{{ __('admin.no_data') }}</td>
                                </tr>
                            @endif
                            @foreach ($socials as $count => $social)
                                <tr data-id="{{ $count + 1 }}">
                                    <td style="width: 80px" class="align-middle">{{ $count + 1 }}</td>
                                    <td class="align-middle">{{ $social->name }}</td>
                                    <td class="align-middle"><img
                                            src="{{ asset('Admin/images/socials/' . $social->icon) }}"
                                            alt="{{ __('admin.icon') }}" style="width: 100px;" /></td>
                                    <td class="align-middle">{{ $social->link }}</td>
                                    <td class="align-middle">
                                        {{ $social->displayed == 0 ? __('admin.hidden') : __('admin.displayed') }}
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex">

                                            <form class="d-inline ml-2" action="{{ route('socials.display') }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="social_id" value="{{ $social->id }}" />
                                                <button type="submit"
                                                    class="btn btn-outline-secondary  bg-primary text-dark btn-sm"
                                                    @if ($social->displayed == 1) title="{{ __('admin.hide') }}" @else title="{{ __('admin.showIcon') }}" @endif>
                                                    <i class="@if ($social->displayed == 1) fas fa-eye-slash @else fas fa-eye @endif"
                                                        style="color:white"></i>
                                                </button>
                                            </form>
                                            <a class="btn btn-outline-secondary bg-warning text-dark btn-sm ml-2"
                                                title="{{ __('admin.edit') }}"
                                                href="{{ route('socials.edit', [$social->id]) }}">
                                                <i class="fas fa-pencil-alt" style="color:white"></i>
                                            </a>

                                            <button type="submit"
                                                class="modal-effect btn btn-outline-secondary bg-danger text-dark btn-sm"
                                                title="{{ __('admin.delete') }}" data-effect="effect-newspaper"
                                                data-toggle="modal" href="#myModal{{ $social->id }}">
                                                <i class="fas fa-trash-alt" style="color:white"></i>
                                            </button>
                                        </div>


                                        <div class="modal" id="myModal{{ $social->id }}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ __('admin.deleteTitleSocial') }}</h5>
                                                        <button aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{ __('admin.deletemsageSocial') }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form class="d-inline" action="{{ route('socials.destroy') }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('Delete')
                                                            <input type="hidden" name="social_id"
                                                                value="{{ $social->id }}" />
                                                            <button type="button" class="btn btn-secondary waves-effect"
                                                                data-dismiss="modal">{{ __('admin.back') }} </button>
                                                            <button type="submit"
                                                                class="btn btn-danger waves-effect waves-light">حذف</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 pagination-box">
                            {{ $socials->links() }}
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
