@extends('layouts.app-dashboard')

@section('title')
Users Management
@stop


@section('content')
    <style>
     

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

    <div class="card">
        <div class="card-header">
            <h5> Users Information </h5>
            <br>

            <a  type="button" href="{{route('users.create')}}"
                class="btn btn-sm btn-primary waves-effect waves-light f-right" >
                Create New User  <i class="icofont icofont-plus"></i>
            </a>
        </div>
        <div class="table-responsive hoverable-table">
            <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                <thead>
                <tr>
                    <th class="wd-10p border-bottom-0">#</th>
                    <th class="wd-15p border-bottom-0">Name</th>
                    <th class="wd-20p border-bottom-0">Email</th>
                    <th class="wd-15p border-bottom-0">Status</th>
                    <th class="wd-15p border-bottom-0">Type User</th>
                    <th class="wd-15p border-bottom-0">Image</th>
                    <th class="wd-10p border-bottom-0">Operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                            @if ($user->status == 1)
                            <td><span class="label label-success">{{ $user->status() }}
                            </td>
                            @else
                            <td>
                                <span class="label label-danger">{{ $user->status() }}
                            </td>
                            @endif

                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($user->user_image !='')
                      <img width="100px" height="100px" src="{{asset('files/assets/users/'.$user->user_image)}}" class="user-img img-radius">
                            @else
                                <img width="100px" height="100px" src="https://www.w3schools.com/howto/img_avatar.png" class="form-group">
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info"
                               title="Edit"><li class="icofont icofont-ui-edit"> Edit</li></a>

                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                               data-user_id="{{ $user->id }}" data-name="{{ $user->name }}"
                               data-toggle="modal" href="#delete_user" title="Delete"><li class="icofont icofont-trash"> Delete</li></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <div class="modal fade" id="delete_user"  tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete reservation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('users.destroy', 'test') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <h6 style="color:red" >Are you sure you want to delete the User?</h6>


                                        <input type="hidden" name="user_id" id="user_id" value="">

                                        <input type="text" disabled   name="name" value="" id="name" >

                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer float-center">
                                <button type="submit" class="btn btn-danger float-right">Delete</button>

                                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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


<script>

    $('#delete_user').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var user_id = button.data('user_id')
        var name = button.data('name')
        var modal = $(this)
        modal.find('.modal-body #user_id').val(user_id);
        modal.find('.modal-body #name').val(name);
    })
</script>


@endsection
