@extends('layouts.app-dashboard')

@section('title')
    Edit Permission
@stop



@section('content')
    <link href="{{URL::asset('files/assets/pages/notification/notification.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.brighttheme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.buttons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.history.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.mobile.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/assets/pages/pnotify/notify.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/switchery/dist/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Permissions </h4>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item" style="float: left;">
                        <a href="{{route('admin.index_route')}}"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Permissions</a>
                    </li>
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">All</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>

    @include('layouts.flash')
    <div class="page-body">

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">Edit Permission</h6>
                <div class="ml-auto">
                    <a  type="button" href="{{route('users.index')}}"  data-effect="effect-scale"
                        class="btn btn-sm btn-primary waves-effect waves-light f-right" >
                        <i class="icofont icofont-home"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">

                {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('name', 'Name Permission') !!}
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>


                </div>

                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <b> {!! Form::label('permission', 'Permissions',['style'=>'color:white;Background:red']) !!} </b><br>

                            @foreach($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false) }}
                                    {{ $value->name }}</label><hr>

                            @endforeach
                            @error('permission')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                </div>

                <div class="form-group pt-4">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>

    <!-- row closed -->
    <!-- Container closed -->
    <!-- main-content closed -->
@endsection
@section('script')
    <!-- Internal Treeview js -->
    <script type="text/javascript" src="{{asset('files/bower_components/switchery/dist/switchery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('files/assets/pages/advance-elements/swithces.js')}}"></script>
@endsection
