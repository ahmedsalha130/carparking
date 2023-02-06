@extends('layouts.app-dashboard')
@section('title')
Archive Chats
@endsection
@section('content')


    @php
        date_default_timezone_set("Asia/Gaza");

    @endphp
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
                    <h4>Chat Support</h4>
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
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Chat Support</a>
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
                <h5> Chat  Support </h5>

{{--                <a  type="button" href="#create_chat"  data-effect="effect-scale" data-toggle="modal"--}}
{{--                    class="btn btn-sm btn-primary waves-effect waves-light f-right" >--}}
{{--                    Create New Message  <i class="icofont icofont-plus"></i>--}}
{{--                </a>--}}
            </div>



            <div class="card-block">
                <table id="demo-foo-filtering" class="table table-striped">
                    <thead>
                    <tr>
                        <th data-breakpoints="xs">#</th>
                        <th data-breakpoints="xs">Customer Name</th>
                        <th data-breakpoints="xs">Sent Message</th>
                        <th data-breakpoints="xs">Received Message</th>
                        <th data-breakpoints="xs">Status</th>
                        <th data-breakpoints="xs">Create at</th>
                        <th data-breakpoints="xs">Operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($chats as $chat)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$chat->customer->name}}</td>
                                <td> <a type="button"   data-effect="effect-scale" data-toggle="modal" href="#edit_message" data-id_chat="{{$chat->id}}" data-sent_message="{{$chat->sent_message}}"  data-customer_name="{{$chat->customer->name}}"  class="dropdown-item waves-light waves-effect" >{{ \Illuminate\Support\Str::limit($chat->sent_message,20)}}</a></td>


                            <td> <a type="button"   data-effect="effect-scale" data-toggle="modal" href="#received_message" data-id_chat="{{$chat->id}}" data-replay_message="{{$chat->received_message}}"  data-customer_name="{{$chat->customer->name}}"  class="dropdown-item waves-light waves-effect">{{ \Illuminate\Support\Str::limit($chat->received_message,20)}}</a> </td>
                            @if( $chat->status() =='answered')

                                <td><span class="label label-success"> {{$chat->status()}}</span></td>

                            @else
                                <td><span class="label label-danger"> {{$chat->status()}}</span></td>
                            @endif

                            <td >{{$chat->created_at}}</td>

                            <td>
                                <div class="dropdown-info dropdown open">
                                    <button class="btn btn-info dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><li class="fa fa-gear fa-spin"></li></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
{{--                                        @if($chat->status() !='answered')--}}

{{--                                            <a  type="button"   data-effect="effect-scale" data-toggle="modal" href="#send_message" data-id_chat="{{$chat->id}}"    data-customer_id="{{$chat->customer_id}}" data-customer_name="{{$chat->customer->name}}"  class="dropdown-item waves-light waves-effect" >--}}
{{--                                                <li class="icofont icofont-ui-reply"> Replay</li> </a>--}}
{{--                                        @endif--}}

                                            @can('chat-delete')
                                        <a  class="dropdown-item waves-light waves-effect" href="#delete_chat"  data-id_chat="{{ $chat->id }}" data-customer_name ="{{$chat->customer->name}}"
                                            data-effect="effect-scale" data-toggle="modal" >
                                            <li class="icofont icofont-trash"> Delete</li>  </a>
                                        @endcan
                                        {{--                                        <a  href="#edit_status" data-id_chat="{{ $chat->id }}" data-customer_name ="{{$chat->customer->name}}" data-status_wallet ="{{$wallet->status}}"   data-effect="effect-scale" data-toggle="modal" class="dropdown-item waves-light waves-effect" > <li class="icofont icofont-arrow-right"> Status</li></a>--}}
{{--                                        <a  class="dropdown-item waves-light waves-effect" href="#archive_chat"   data-id_chat="{{$chat->id}}"  data-customer_name ="{{$chat->customer->name}}"--}}
{{--                                            data-effect="effect-scale" data-toggle="modal" >--}}
{{--                                            <li class="icofont icofont-archive"> Archive</li>  </a>--}}
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
                {{$chats->links('vendor.pagination.custom')}}

            </div>

            <!-- create -->
            <div class="modal fade" id="create_chat"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Chat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="add-form" action= "{{route('Chat.store')}}" enctype="multipart/form-data">
                                @csrf
                                @method('POST')


                                <div class="form-group ">
                                    <label for="customer_name" class="col-form-label">Customer Name</label>
                                    <select  name="customer_name" id="customer_name" required  class="form-control">
{{--                                        @foreach($customers as $customer)--}}
{{--                                            <option  value="{{$customer->id}}">{{$customer->name}}</option>--}}
{{--                                        @endforeach--}}

                                    </select>
                                    @error('customer_name')
                                    <span class ='help-block text-danger'>{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="checkbox-fade fade-in-primary d-">
                                    <label>
                                        <input type="checkbox"   name="email" id="email"   >
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Send To Email</span>
                                    </label>
                                </div>

                                <div class="form-group ">

                                    <label for="sent_message" class="col-form-label">Message</label>
                                    <textarea      required name="sent_message" class="form-control" id="sent_message"> </textarea>
                                    @error('sent_message')
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
            <!--   replay message-->
            <div class="modal fade" id="send_message"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Replay Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST"  id="add-form" action= "{{route('Chat.update',1)}}" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PATCH') }}
                                <input type="hidden"   name="id_chat" value="" class="form-control" id="id_chat">
                                <input type="hidden"   name="customer_id" value="" class="form-control" id="customer_id">

                                <div class="form-group">
                                    <label for="customer_name" class="col-form-label">Customer Name</label>
                                    <input type="text" disabled  name="customer_name" value="{{old('customer_name')}}" class="form-control" id="customer_name">
                                </div>
                                <div class="checkbox-fade fade-in-primary d-">
                                    <label>
                                        <input type="checkbox"   name="email" id="email"   >
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Send To Email</span>
                                    </label>
                                </div>

                                <div class="form-group ">

                                    <label for="sent_message" class="col-form-label">Message</label>
                                    <textarea      required name="sent_message" class="form-control" id="sent_message"> </textarea>
                                    @error('sent_message')
                                    <span class ='help-block text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="modal-footer float-right">
                                    <button type="submit" class="btn btn-primary float-right">Send Message</button>

                                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--   edit message-->
            <div class="modal fade" id="edit_message"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Sent Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST"  id="add-form" action= "{{route('Chat.update',1)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden"   name="id_chat" value="" class="form-control" id="id_chat">

                                <div class="form-group">
                                    <label for="customer_name" class="col-form-label">Customer Name</label>
                                    <input type="text" disabled  name="customer_name" value="{{old('customer_name')}}" class="form-control" id="customer_name">
                                </div>
{{--                                <div class="checkbox-fade fade-in-primary d-">--}}
{{--                                    <label>--}}
{{--                                        <input type="checkbox"   name="email" id="email"   >--}}
{{--                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
{{--                                        <span class="text-inverse">Send To Email</span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}

                                <div class="form-group ">

                                    <label for="amount_value" class="col-form-label">Message</label>
                                    <textarea  readonly     required name="sent_message" class="form-control" id="sent_message"> </textarea>
                                    @error('sent_message')
                                    <span class ='help-block text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="modal-footer float-right">
{{--                                    <button type="submit" class="btn btn-primary float-right">Send Message</button>--}}

                                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--   show message-->
            <div class="modal fade" id="received_message"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Show Received Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST"  id="add-form" action= "{{route('PaymentWallet.update',1)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden"   name="id_chat" value="" class="form-control" id="id_chat">

                                <div class="form-group">
                                    <label for="customer_name" class="col-form-label">Customer Name</label>
                                    <input type="text" disabled  name="customer_name" value="{{old('customer_name')}}" class="form-control" id="customer_name">
                                </div>


                                <div class="form-group ">

                                    <label for="amount_value" class="col-form-label">Message</label>
                                    <textarea   readonly   required name="replay_message" class="form-control" id="replay_message"> </textarea>
                                    @error('sent_message')
                                    <span class ='help-block text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="modal-footer float-right">
                                    {{--                                    <button type="submit" class="btn btn-primary float-right">Send Message</button>--}}

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
            <div class="modal fade" id="delete_chat"  tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Chat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="add-form" action= "{{route('ArchiveChat.destroy',1)}}">
                                @csrf
                                {{method_field('delete')}}
                                <div class="form-group">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <h6 style="color:red" >Are you sure you want to delete the Chat?</h6>


                                            <input type="hidden" name="id_chat" id="id_chat" value="">
                                            <input type="hidden" name="id_operation" id="id_operation" value="1">

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
            <div class="modal fade" id="archive_chat"  tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Archive Chat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="add-form" action= "{{route('ArchiveChat.destroy',1)}}">
                                @csrf
                                {{method_field('delete')}}
                                <div class="form-group">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <h6 style="color:red" >Are you sure you want to Archive the Chat?</h6>


                                            <input type="hidden" name="id_chat" id="id_chat" value="">
                                            <input type="hidden" name="id_operation" id="id_operation" value="2">

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
        </div>

    </div>

@section('script')


    <script>
        $('#delete_chat').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_chat = button.data('id_chat')
            var customer_name = button.data('customer_name')



            var modal = $(this)
            modal.find('.modal-body #id_chat').val(id_chat);
            modal.find('.modal-body #customer_name').val(customer_name);

        })

        $('#archive_chat').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_chat = button.data('id_chat')
            var customer_name = button.data('customer_name')



            var modal = $(this)
            modal.find('.modal-body #id_chat').val(id_chat);
            modal.find('.modal-body #customer_name').val(customer_name);

        })
        $('#send_message').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_chat = button.data('id_chat')
            var customer_name = button.data('customer_name')
            var customer_id = button.data('customer_id')
            var replay_message = button.data('replay_message')




            var modal = $(this)
            modal.find('.modal-body #id_chat').val(id_chat);
            modal.find('.modal-body #customer_name').val(customer_name);
            modal.find('.modal-body #customer_id').val(customer_id);
            modal.find('.modal-body #replay_message').val(replay_message);

        })
        $('#edit_message').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_chat = button.data('id_chat')
            var customer_name = button.data('customer_name')
            var sent_message = button.data('sent_message')




            var modal = $(this)
            modal.find('.modal-body #id_chat').val(id_chat);
            modal.find('.modal-body #customer_name').val(customer_name);
            modal.find('.modal-body #sent_message').val(sent_message);

        })
        $('#received_message').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_chat = button.data('id_chat')
            var customer_name = button.data('customer_name')
            var replay_message = button.data('replay_message')




            var modal = $(this)
            modal.find('.modal-body #id_chat').val(id_chat);
            modal.find('.modal-body #customer_name').val(customer_name);
            modal.find('.modal-body #replay_message').val(replay_message);

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
