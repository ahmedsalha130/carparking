@extends('layouts.app-dashboard')
@section('title')
Active Customer
@endsection
@section('content')

    <link href="{{URL::asset('files/assets/pages/notification/notification.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.brighttheme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.buttons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.history.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/bower_components/pnotify/dist/pnotify.mobile.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/files/assets/pages/pnotify/notify.css')}}">

    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Active Customers</h4>
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
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Customers</a>
                    </li>
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Active</a>
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
                <h5> Customer Information </h5>
                <a  type="button" href="{{route('customer.create')}}"  data-effect="effect-scale"
                    class="btn btn-sm btn-primary waves-effect waves-light f-right" >
                    Create New Customer  <i class="icofont icofont-plus"></i>
                </a>
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                        <tr>

                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Operation</th>
                        </tr>
                        </thead>


                        @forelse($customers as $customer)


                            <tbody>
                            <tr>

                                <td>{{$loop->iteration}}n</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->mobile}}</td>

                                @if($customer->status() =='active')

                                    <td><span class="label label-success"> {{$customer->status()}}</span></td>
                                @else
                                    <td><span class="label label-danger"> {{$customer->status()}}</span></td>
                                @endif
                                <td>{{$customer->created_at}}</td>
                                <td>

                                    <div class="dropdown-info dropdown open">
                                        <button class="btn btn-info dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><li class="fa fa-gear fa-spin"></li></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                            <a  type="button"  href="{{route('customer.edit',$customer->id)}}" class="dropdown-item waves-light waves-effect" > <li class="icofont icofont-ui-edit"> Edit</li> </a>

                                            <a  class="dropdown-item waves-light waves-effect" href="#delete_customer"  data-id_customer="{{ $customer->id }}" data-customer_name ="{{$customer->name}}"
                                                data-effect="effect-scale" data-toggle="modal" >
                                                <li class="icofont icofont-trash"> Delete</li>

                                            </a>
                                            <a  class="dropdown-item waves-light waves-effect" href="#archive_customer"  data-id_customer="{{ $customer->id }}" data-customer_name ="{{$customer->name}}"
                                                data-effect="effect-scale" data-toggle="modal" >
                                                <li class="icofont icofont-archive"> Archive</li>  </a>

                                            <a  href="{{route('customer.show',$customer->id)}}" class="dropdown-item waves-light waves-effect" > <li class="icofont icofont-eye"> Details</li></a>
                                            {{--                                        <a  href="#edit_status" data-id_reservation="{{ $reservation->id }}" data-reservation_number ="{{$reservation->number}}" data-status_reservation ="{{$reservation->status}}"   data-effect="effect-scale" data-toggle="modal" class="dropdown-item waves-light waves-effect" > <li class="icofont icofont-arrow-right"> Status</li></a>--}}

                                        </div>
                                    </div>



                                </td>
                            </tr>

                            </tbody>

                        @empty
                            <tr>No  records found  </tr>

                        @endforelse
                        <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Operation</th>
                        </tr>
                        </tfoot>
                    </table>
                    {{ $customers->links('vendor.pagination.custom') }}

                </div>
            </div>
            <!-- Delete Customer -->
            <div class="modal fade" id="delete_customer"  tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="add-form" action= "{{route('customer.destroy','delete')}}">
                                @csrf
                                {{method_field('delete')}}
                                <div class="form-group">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <h6 style="color:red" >Are you sure you want to delete the customer?</h6>


                                            <input type="hidden" name="id_customer" id="id_customer" value="">
                                            <input type="hidden" name="id_operation" id="id_operation" value="1">

                                            <input type="text" disabled   name="customer_name" value="" id="customer_name" >

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

            <div class="modal fade" id="archive_customer"  tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Archive Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="add-form" action= "{{route('customer.destroy','delete')}}">
                                @csrf
                                {{method_field('delete')}}
                                <div class="form-group">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <h6 style="color:red" >Move the customer to the archive Customer?</h6>


                                            <input type="hidden" name="id_customer" id="id_customer" value="">

                                            <input type="text" disabled   name="customer_name" value="" id="customer_name" >

                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer float-center">
                                    <button type="submit" class="btn btn-danger float-right">Archive</button>

                                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@section('script')
    <script>
        $('#delete_customer').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_customer = button.data('id_customer')
            var customer_name = button.data('customer_name')
            var modal = $(this)
            modal.find('.modal-body #id_customer').val(id_customer);
            modal.find('.modal-body #customer_name').val(customer_name);
        })
        $('#archive_customer').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_customer = button.data('id_customer')
            var customer_name = button.data('customer_name')
            var modal = $(this)
            modal.find('.modal-body #id_customer').val(id_customer);
            modal.find('.modal-body #customer_name').val(customer_name);
        })
    </script>
@endsection

@endsection
