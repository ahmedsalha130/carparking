@extends('layouts.app-dashboard')
@section('content')


    @php
        date_default_timezone_set("Asia/Gaza");

    @endphp
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
                    <h4>Payment Wallet</h4>
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
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">PaymentWallet</a>
                    </li>
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
                <h5> PaymentWallet Information </h5>

                                <a  type="button" href="#create_wallet"  data-effect="effect-scale" data-toggle="modal"
                                    class="btn btn-sm btn-primary waves-effect waves-light f-right" >
                                    Create New PaymentWallet  <i class="icofont icofont-plus"></i>
                                </a>
            </div>



            <div class="card-block">
                <table id="demo-foo-filtering" class="table table-striped">
                    <thead>
                    <tr>
                        <th data-breakpoints="xs">#</th>
                        <th data-breakpoints="xs">Number</th>
                        <th data-breakpoints="xs">Customer</th>
                        <th data-breakpoints="xs">Status</th>
                        <th data-breakpoints="xs">Amount</th>
                        <th data-breakpoints="xs">Operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($wallets as $wallet)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$wallet->number}}</td>
                        <td>{{$wallet->customer->name}}</td>

                        @if( $wallet->status() =='Active')

                            <td><span class="label label-success"> {{$wallet->status()}}</span></td>

                        @else
                            <td><span class="label label-danger"> {{$wallet->status()}}</span></td>
                        @endif

                        @if($wallet->amount <=0)
                        <td class="table-danger">${{$wallet->amount}}</td>
                        @else
                            <td class="table-success">${{$wallet->amount}}</td>

                        @endif
                        <td>
                            <div class="dropdown-info dropdown open">
                                <button class="btn btn-info dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><li class="fa fa-gear fa-spin"></li></button>
                                <div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                    <a  type="button"   data-effect="effect-scale" data-toggle="modal" href="#edit_wallet" data-id_wallet="{{$wallet->id}}" data-status_wallet ="{{$wallet->status}}"  data-wallet_number="{{$wallet->number}}" data-wallet_amount ="{{$wallet->amount}}" data-customer_id ="{{$wallet->customer->id}}" data-customer_name ="{{$wallet->customer->name}}"  class="dropdown-item waves-light waves-effect" >
                                        <li class="icofont icofont-ui-edit"> Edit</li> </a>

                                    <a  class="dropdown-item waves-light waves-effect" href="#delete_wallet"  data-id_wallet="{{ $wallet->id }}" data-wallet_number ="{{$wallet->number}}" data-customer_name ="{{$wallet->customer->name}}"
                                        data-effect="effect-scale" data-toggle="modal" >
                                        <li class="icofont icofont-trash"> Delete</li>  </a>

                                    <a  href="#edit_status" data-id_wallet="{{ $wallet->id }}" data-wallet_number ="{{$wallet->number}}" data-status_wallet ="{{$wallet->status}}"   data-effect="effect-scale" data-toggle="modal" class="dropdown-item waves-light waves-effect" > <li class="icofont icofont-arrow-right"> Status</li></a>
                                    <a  class="dropdown-item waves-light waves-effect" href="#archive_wallet"   data-id_wallet="{{ $wallet->id }}" data-wallet_number ="{{$wallet->number}}" data-customer_name ="{{$wallet->customer->name}}"
                                        data-effect="effect-scale" data-toggle="modal" >
                                        <li class="icofont icofont-archive"> Archive</li>  </a>
                                </div>
                            </div>

                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td> No Recorders</td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>

                </div>

                <!-- create -->
                <div class="modal fade" id="create_wallet"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New PaymentWallet</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" id="add-form" action= "{{route('PaymentWallet.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')


                                    <div class="form-group ">
                                        <label for="customer_name" class="col-form-label">Customer Name</label>
                                        <select  name="customer_name" id="customer_name" required  class="form-control">
                                            @foreach($customers as $customer)
                                            <option  value="{{$customer->id}}">{{$customer->name}}</option>
                                            @endforeach

                                        </select>
                                        @error('customer_name')
                                        <span class ='help-block text-danger'>{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group ">

                                        <label for="amount_value" class="col-form-label">Amount</label>
                                        <input type="number" min="0"  required name="amount_value" class="form-control" id="amount_value">
                                        @error('amount_value')
                                        <span class ='help-block text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group ">

                                    <select  name="status" id="status" required  class="form-control">

                                        <option  value="1">Active</option>
                                        <option  value="0">Disable</option>


                                    </select>
                                    @error('status')
                                    <span class ='help-block text-danger'>{{ $message }}</span>
                                    @enderror

                                    </div>

                                    <div class="modal-footer float-right">
                                        <button type="submit" class="btn btn-primary float-right">Save</button>

                                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  Edit -->
                <div class="modal fade" id="edit_wallet"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update PaymentWallet</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="POST"  id="add-form" action= "{{route('PaymentWallet.update',1)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden"   name="id_wallet" value="" class="form-control" id="id_wallet">
                                    <input type="hidden"   name="customer_id" value="" class="form-control" id="customer_id">

                                    <div class="form-group">
                                        <label for="number_wallet" class="col-form-label">No.PaymentWallet</label>
                                        <input type="text" disabled required name="wallet_number" value="{{old('wallet_number')}}" class="form-control" id="wallet_number">
                                        <label for="customer_name" class="col-form-label">Customer Name</label>
                                        <input type="text" disabled required name="customer_name" value="{{old('customer_name')}}" class="form-control" id="customer_name">
                                    </div>


                                    <div class="form-group ">

                                        <label for="amount_value" class="col-form-label">Amount</label>
                                        <input type="number" min="0"   value="" required name="amount_value" class="form-control" id="wallet_amount">
                                        @error('amount_value')
                                        <span class ='help-block text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group ">

                                        <select  name="status" id="status_wallet" required  class="form-control">

                                            <option  value="1">Active</option>
                                            <option  value="0">Disable</option>


                                        </select>
                                        @error('status')
                                        <span class ='help-block text-danger'>{{ $message }}</span>
                                        @enderror

                                    </div>


                                    <div class="modal-footer float-right">
                                        <button type="submit" class="btn btn-primary float-right">Update PaymentWallet</button>

                                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Delete Model -->
                <div class="modal fade" id="delete_wallet"  tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete PaymentWallet</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" id="add-form" action= "{{route('PaymentWallet.destroy',1)}}">
                                    @csrf
                                    {{method_field('delete')}}
                                    <div class="form-group">
                                        <div class="file-field input-field">
                                            <div class="btn">
                                                <h6 style="color:red" >Are you sure you want to delete the PaymentWallet?</h6>


                                                <input type="hidden" name="id_wallet" id="id_wallet" value="">
                                                <input type="hidden" name="id_operation" id="id_operation" value="1">

                                                <label for="number_wallet" class="col-form-label">No.PaymentWallet</label>
                                                <input type="text"  disabled required name="wallet_number" value="{{old('wallet_number')}}" class="form-control text-center" id="wallet_number">
                                                <label for="customer_name" class="col-form-label">Customer Name</label>
                                                <input type="text" disabled required name="customer_name" value="{{old('customer_name')}}" class="form-control text-center" id="customer_name">

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

            <!-- Archive Model -->
            <div class="modal fade" id="archive_wallet"  tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete PaymentWallet</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="add-form" action= "{{route('PaymentWallet.destroy',1)}}">
                                @csrf
                                {{method_field('delete')}}
                                <div class="form-group">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <h6 style="color:red" >Are you sure you want to Archive the PaymentWallet?</h6>


                                            <input type="hidden" name="id_wallet" id="id_wallet" value="">
                                            <input type="hidden" name="id_operation" id="id_operation" value="0">

                                            <label for="number_wallet" class="col-form-label">No.PaymentWallet</label>
                                            <input type="text"  disabled required name="wallet_number" value="{{old('wallet_number')}}" class="form-control text-center" id="wallet_number">
                                            <label for="customer_name" class="col-form-label">Customer Name</label>
                                            <input type="text" disabled required name="customer_name" value="{{old('customer_name')}}" class="form-control text-center" id="customer_name">

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
                <!-- Edit Status -->
                <div class="modal fade" id="edit_status"  tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Status PaymentWallet</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="post" id="add-form" action= "{{route('admin.wallet_status','status')}}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <div class="file-field input-field">
                                            <div class="btn">


                                                <input type="hidden" name="id_wallet" id="id_wallet" value="">

                                                <label for="number_wallet" class="col-form-label">No.PaymentWallet</label>
                                                <input type="text"  disabled required name="wallet_number" value="{{old('wallet_number')}}" class="form-control text-center" id="wallet_number">

                                            </div>


                                    <div class="form-group ">

                                        <select  name="status" id="status_wallet" required  class="form-control">

                                            <option  value="1">Active</option>
                                            <option  value="0">Disable</option>


                                        </select>
                                        @error('status')
                                        <span class ='help-block text-danger'>{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="modal-footer float-center">
                                        <button type="submit" class="btn btn-success float-right">Change</button>

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
            $('#delete_wallet').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id_wallet = button.data('id_wallet')
                var wallet_number = button.data('wallet_number')
                var customer_name = button.data('customer_name')



                var modal = $(this)
                modal.find('.modal-body #id_wallet').val(id_wallet);
                modal.find('.modal-body #wallet_number').val(wallet_number);
                modal.find('.modal-body #customer_name').val(customer_name);

            })

            $('#archive_wallet').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id_wallet = button.data('id_wallet')
                var wallet_number = button.data('wallet_number')
                var customer_name = button.data('customer_name')



                var modal = $(this)
                modal.find('.modal-body #id_wallet').val(id_wallet);
                modal.find('.modal-body #wallet_number').val(wallet_number);
                modal.find('.modal-body #customer_name').val(customer_name);

            })

            $('#edit_wallet').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id_wallet = button.data('id_wallet')
                var wallet_number = button.data('wallet_number')
                var customer_name = button.data('customer_name')
                var customer_id = button.data('customer_id')
                var status_wallet = button.data('status_wallet')
                var wallet_amount = button.data('wallet_amount')



                var modal = $(this)
                modal.find('.modal-body #id_wallet').val(id_wallet);
                modal.find('.modal-body #wallet_number').val(wallet_number);
                modal.find('.modal-body #customer_name').val(customer_name);
                modal.find('.modal-body #customer_id').val(customer_id);
                modal.find('.modal-body #status_wallet').val(status_wallet);
                modal.find('.modal-body #wallet_amount').val(wallet_amount);
            })

            $('#edit_status').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id_wallet = button.data('id_wallet')
                var wallet_number = button.data('wallet_number')
                var status_wallet = button.data('status_wallet')

                var modal = $(this)
                modal.find('.modal-body #id_wallet').val(id_wallet);
                modal.find('.modal-body #wallet_number').val(wallet_number);
                modal.find('.modal-body #status_wallet').val(status_wallet);

            })
            $("#edit_wallet").on("change", function () {
                $modal = $('#status_wallet');
                if($(this).val() === 0){
                    $modal.modal('hide');

                }else {

                }
            });

            $("#status_wallet").on("change", function () {
                $modal = $('#status_wallet');
                if($(this).val() === 0){
                    $modal.modal('hide');

                }else {

                }
            });
        </script>

    @endsection

    @endsection

    @endsection
