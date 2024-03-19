@extends('layouts.master')
@section('title')
    {{ __('admin.users') }}
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('admin.edit_user') }}
        @endslot
        @slot('title')
            {{ __('admin.users') }}
        @endslot
    @endcomponent

@section('css')
    <style>
        .image-deleter {
            all: unset;
            outline: none !important;
            position: absolute;
            top: 0px;
            right: 0px;
        }

        .image-deleter:hover {
            cursor: pointer;
            background: #3333;
        }

        .image-deleter::before {
            content: 'X';
            font-size: 32px;
            border: 3px solid #ea4335;
            color: #ea4335;
            padding: 10px 25px;
            border-radius: 50%;
            font-weight: 700;
        }
    </style>
@endsection
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">{{ __('admin.edit_user') }}</h4>
            </div>
            <div class="card-body">
                <form class="needs-validation" action="{{ route('users.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('layouts.session')
                    @component('components.errors')
                        @slot('id')
                            user_id
                        @endslot
                    @endcomponent
                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="image">{{ __('admin.image') }} <span
                                        class="text-danger fw-bolder"></span></label>
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
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('admin.name') }} <span
                                        class="text-danger fw-bolder">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="{{ __('admin.name') }}"
                                    value="{{ $user->name }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label" for="email"> {{ __('admin.email') }} <span
                                        class="text-danger fw-bolder">*</span></label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder=" {{ __('admin.email') }}"
                                    value="{{ $user->email }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label" for="phone"> {{ __('admin.phone') }} <span
                                        class="text-danger fw-bolder">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" placeholder=" {{ __('admin.phone') }}"
                                    value="{{ $user->phone }}" required>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label" for="twitter"> {{ __('admin.twitter') }} <span
                                        class="text-danger fw-bolder"></span></label>
                                <input type="url" class="form-control @error('twitter') is-invalid @enderror"
                                    id="twitter" name="twitter" placeholder=" {{ __('admin.twitter') }}"
                                    value="{{ $user->twitter }}">
                                @error('twitter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label" for="lat"> {{ __('admin.lat') }} <span
                                        class="text-danger fw-bolder">*</span></label>
                                <input type="text" class="form-control @error('lat') is-invalid @enderror"
                                    id="lat" name="lat" placeholder=" {{ __('admin.lat') }}"
                                    value="{{ $user->lat }}" required>
                                @error('lat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label" for="long"> {{ __('admin.long') }} <span
                                        class="text-danger fw-bolder">*</span></label>
                                <input type="text" class="form-control @error('long') is-invalid @enderror"
                                    id="long" name="long" placeholder=" {{ __('admin.long') }}"
                                    value="{{ $user->long }}" required>
                                @error('long')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label" for="address"> {{ __('admin.address') }} <span
                                        class="text-danger fw-bolder">*</span></label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" name="address" placeholder=" {{ __('admin.address') }}"
                                    value="{{ $user->address }}" required>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label" for="password"> {{ __('admin.password') }} <span
                                        class="text-danger fw-bolder"></span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder=" {{ __('admin.password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit"> {{ __('admin.edit_user') }}</button>
                </form>


            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div>
@endsection
