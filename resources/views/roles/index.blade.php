@extends('layouts.app-dashboard')

@section('title')
    Users Permissions
@stop


@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                Users Permissions</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

    @include('layouts.flash')

<!-- row -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">Add</a>
                        </div>
                    </div>
                    <br>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('roles.show', $role->id) }}">Show</a>

                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('roles.edit', $role->id) }}">Edit</a>

                                        @if ($role->name !== 'owner')
                                                {{--  {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',
                                                $role->id], 'style' => 'display:inline']) !!}  --}}

                                                {{--  {!! Form::submit('حذف', ['class' => 'btn btn-danger btn-sm') !!}
                                                {!! Form::close() !!}  --}}
                                                <button class="btn btn-danger btn-sm" href="#" data-role_name="{{ $role->name }}"  data-id_role="{{ $role->id }}"
                                                    data-toggle="modal" data-target="#delete_role">Delete
                                                    </button>
                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->
</div>


                    <!-- delete -->
                    <div class="modal fade" id="delete_role" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> Permission Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('roles.destroy','test') }}" method="post">

                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                                <div class="modal-body">
                                    <p class="text-center">
                                    <h6 style="color:red">Are you sure of the process of deleting the validity ?</h6>
                                    </p>

                                    <input type="hidden" name="id" id="id_role" value="">
                                    <input type="text" disabled name="role_name" id="role_name" value="">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('script')

<script>
       $('#delete_role').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_role = button.data('id_role')
        var role_name = button.data('role_name')
        var modal = $(this)
        modal.find('.modal-body #id_role').val(id_role);
        modal.find('.modal-body #role_name').val(role_name);
    })
</script>
@endsection
