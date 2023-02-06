@extends('layouts.app-dashboard')

@section('title')
    Show Permission
@stop


@section('content')
    <style>
        img {
            border-radius: 50%;
        }

    </style>
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
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Permission</a>
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

        <div class="card">
            <div class="card-header">
                <h5> Permission  </h5>

            </div>
            <div class="table-responsive hoverable-table">
                <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                    <thead>
                    <tr>
                        <th class="wd-10p border-bottom-0">#</th>
                        <th class="wd-15p border-bottom-0">Name</th>

                    </tr>
                    </thead>
                    <tbody>

                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                                    <td>{{ $v->name }}    </td>



                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>



        </div>

    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    </div>
    </div>

    <!-- main-content closed -->
@endsection
@section('script')




@endsection
