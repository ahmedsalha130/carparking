@extends('layouts.app-dashboard')

@section('title')
Edit User
@stop


@section('content')
    <link href="{{URL::asset('files/assets/pages/notification/notification.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.brighttheme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.buttons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.history.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.mobile.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/assets/pages/pnotify/notify.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Users Management</h4>
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
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Users</a>
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
                <h6 class="m-0 font-weight-bold text-primary">Edit  User</h6>
                <div class="ml-auto">
                    <a  type="button" href="{{route('users.index')}}"  data-effect="effect-scale"
                        class="btn btn-sm btn-primary waves-effect waves-light f-right" >
                        <i class="icofont icofont-home"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">

                {!! Form::model($user, ['method' => 'PATCH','files' => true,'route' => ['users.update', $user->id],'class'=>'parsley-style-1','data-parsley-validate=""','autocomplete'=>'off']) !!}
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('mobile', 'Mobile') !!}
                            {!! Form::text('mobile', old('mobile'), ['class' => 'form-control']) !!}
                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('password', 'Password') !!}
                            {!! Form::password('password', ['class' => 'form-control' ,'autocomplete'=>'false']) !!}
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Re-Password') !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control','autocomplete'=>'false']) !!}
                            @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('status', 'status') !!}
                            {!! Form::select('status', ['' => '---', '1' => 'active', '0' => 'Disable', ],old('status'), ['class' => 'form-control']) !!}
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>


                </div>
                <div class="row">


                    <div class="col-6">
                        {!! Form::label('roles_name', 'Permissions') !!}
                        <div class="form-group">

                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control parsley-style-1','multiple')) !!}

                            @error('roles_name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">

                    @if ($user->user_image != '')
                        <div class="col-12 text-center">
                            <div id="imgArea">
                                <img src="{{ asset('files/assets/users/' . $user->user_image) }}" width="200" height="200">
                                <button class="btn btn-danger removeImage">Remove Image</button>
                            </div>
                        </div>
                    @endif
                    <div class="col-6">
                        {!! Form::label('user_image', 'User Image') !!}
                        <br>
                        <div class="file-loading">
                            {!! Form::file('user_image', ['id' => 'user-image', 'class' => 'file-input-overview']) !!}
                            <span class="form-text text-muted">Image width should be 100px x 100px</span>
                            @error('user_image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
    </div>
@section('script')
    <script>
        $(function () {
            $('#user-image').fileinput({
                theme: "fa",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
        });

        $('.removeImage').click(function () {
            $.post('{{ route('user.remove_image') }}', { user_id: '{{ $user->id }}', _token: '{{ csrf_token() }}'}, function (data) {
                if (data == 'true') {
                    window.location.href = window.location;
                }
            })

        });
    </script>
@endsection
@endsection

