@extends('layouts.app-dashboard')
@section('title')
Payment
@endsection
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

{{--                                <a  type="button" href="#create_wallet"  data-effect="effect-scale" data-toggle="modal"--}}
{{--                                    class="btn btn-sm btn-primary waves-effect waves-light f-right" >--}}
{{--                                    Create New PaymentWallet  <i class="icofont icofont-plus"></i>--}}
{{--                                </a>--}}
            </div>



            <div class="card-block">
                <table id="demo-foo-filtering" class="table table-striped">
                    <thead>
                    <tr>
                        <th data-breakpoints="xs">#</th>
                        <th data-breakpoints="xs">Time Price</th>
                        <th data-breakpoints="xs">Amount Commission</th>
                        <th data-breakpoints="xs">Discount</th>
                        <th data-breakpoints="xs">Total Profit</th>
                        <th data-breakpoints="xs">Operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($wallets as $wallet)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>${{$wallet->time_price}}</td>
                        <td>${{$wallet->amount_commission}}</td>
                        <td>${{$wallet->discount}}</td>
                        <td class="table-success">${{$wallet->total_profit}}</td>


                        <td>
                            <div class="dropdown-info dropdown open">
                                <button class="btn btn-info dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><li class="fa fa-gear fa-spin"></li></button>
                                <div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                             @can('payment-edit')

                                    <a  type="button"   data-effect="effect-scale" data-toggle="modal" href="#edit_wallet" data-id_wallet="{{$wallet->id}}" data-time_price ="{{$wallet->time_price}}"  data-amount_commission="{{$wallet->amount_commission}}" data-discount ="{{$wallet->discount}}" data-total_profit ="{{$wallet->total_profit}}"   class="dropdown-item waves-light waves-effect" >
                                        <li class="icofont icofont-ui-edit"> Edit</li> </a>
                                             @endcan

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

                                <form method="POST"  id="add-form" action= "{{route('Payment.update',1)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden"   name="id_wallet" value="" class="form-control" id="id_wallet">

                                    <div class="form-group">
                                        <label for="time_price" class="col-form-label">Time Price</label>
                                        <input type="text"   required name="time_price"   class="form-control" id="time_price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                               value=0 >
                                        @error('time_price')
                                        <span class ='help-block text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group ">

                                        <label for="amount_value" class="col-form-label">Amount Commission</label>
                                        <input type="text"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required name="amount_commission" class="form-control" id="amount_commission">
                                        @error('amount_value')
                                        <span class ='help-block text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group ">

                                        <label for="discount" class="col-form-label">Discount</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  value="" required name="discount" class="form-control" id="discount">
                                        @error('discount')
                                        <span class ='help-block text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                  <div class="form-group ">

                                        <label for="total_profit" class="col-form-label">Total Profit</label>
                                        <input type="text"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"   value=""  readonly  name="total_profit" class="form-control" id="total_profit">
                                        @error('discount')
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
                var amount_commission = button.data('amount_commission')
                var time_price = button.data('time_price')
                var discount = button.data('discount')
                var total_profit = button.data('total_profit')



                var modal = $(this)
                modal.find('.modal-body #id_wallet').val(id_wallet);
                modal.find('.modal-body #amount_commission').val(amount_commission);
                modal.find('.modal-body #time_price').val(time_price);
                modal.find('.modal-body #discount').val(discount);
                modal.find('.modal-body #total_profit').val(total_profit);
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
