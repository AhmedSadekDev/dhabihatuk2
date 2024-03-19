@extends('layouts.master')
@section('title')
    {{ __('admin.socials') }}
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('admin.edit_social') }}
        @endslot
        @slot('title')
            {{ __('admin.socials') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-0">{{ __('admin.edit_social') }}</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('socials.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('layouts.session')
                        @component('components.errors')
                            @slot('id')
                                social_id
                            @endslot
                        @endcomponent
                        <input type="hidden" name="social_id" value="{{ $social->id }}" />
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="icon">{{ __('admin.icon') }}</label>
                                    <div>
                                        <img src="{{ asset('Admin/images/socials/' . $social->icon) }}"
                                            alt="{{ __('admin.icon') }}" class="img-thumbnail wd-100p wd-sm-200" />
                                    </div>
                                    <input type="file" class="form-control @error('icon') is-invalid @enderror"
                                        id="icon" name="icon">
                                    @error('icon')
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
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">{{ __('admin.name') }} <span
                                                    class="text-danger fw-bolder">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="{{ __('admin.name') }}"
                                                value="{{ old('name') ? old('name') : $social->name }}" required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <label class="form-label" for="link">{{ __('admin.link') }} <span
                                            class="text-danger fw-bolder">*</span></label>
                                    <input type="url" class="form-control @error('link') is-invalid @enderror"
                                        id="link" name="link" placeholder="{{ __('admin.link') }}"
                                        value="{{ old('link') ? old('link') : $social->link }}" required>
                                    @error('link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">{{ __('admin.edit_social') }}</button>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
