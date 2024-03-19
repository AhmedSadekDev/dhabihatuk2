@extends('layouts.master2')

@section('title')
    @lang('لا يمكنك التحكم')
@endsection

@section('css')
<!--- Internal Fontawesome css-->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!---Ionicons css-->
<link href="{{URL::asset('assets/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
<!---Internal Typicons css-->
<link href="{{URL::asset('assets/plugins/typicons.font/typicons.css')}}" rel="stylesheet">
<!---Internal Feather css-->
<link href="{{URL::asset('assets/plugins/feather/feather.css')}}" rel="stylesheet">
<!---Internal Falg-icons css-->
<link href="{{URL::asset('assets/plugins/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
@endsection
@section('content')
		<!-- Main-error-wrapper -->
		<div class="main-error-wrapper  page page-h ">
            <h1 class="error-title mt-5"><span>401</span></h1>
            <h4 class="text-uppercase my-4">عذراً، لا يمكنك التحكم في هذه الصفحة</h4>
            <a class="btn btn-outline-danger" href="{{route('admin')}}">العودة إلى لوحة التحكم</a>
		</div>
		<!-- /Main-error-wrapper -->
@endsection
@section('js')
@endsection
