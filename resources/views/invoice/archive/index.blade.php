@extends('layouts.app-dashboard')
@section('title')
Archive Invoices
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
                    <h4>Archive Invoices </h4>
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
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Invoices</a>
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
                <h5> Invoices Information </h5>
{{--                <a  type="button" href="{{route('Invoices.create')}}"  data-effect="effect-scale"--}}
{{--                    class="btn btn-sm btn-primary waves-effect waves-light f-right" >--}}
{{--                    Create New Invoice  <i class="icofont icofont-plus"></i>--}}
{{--                </a>--}}
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered " style="width:100%">
                        <thead>
                        <tr>

                            <th>No.</th>
                            <th>Number</th>
                            <th> Customer Name</th>
                            <th>Reservation Number</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Invoice Date</th>
                            <th>Operation</th>
                        </tr>
                        </thead>


                        @forelse($invoices as $invoice)


                            <tbody>
                            <tr>

                                <td>{{$loop->iteration}}n</td>
                                <td>{{$invoice->number}}</td>
                                <td>{{$invoice->customer->name}}</td>
                                <td>{{$invoice->reservation->number}}</td>

                                @if($invoice->status() =='paid')

                                    <td><span class="label label-success"> {{$invoice->status()}}</span></td>
                                @else
                                    <td><span class="label label-danger"> {{$invoice->status()}}</span></td>
                                @endif
                                <td class="table-success">${{$invoice->total}}</td>
                                <td>{{$invoice->invoice_date}}</td>
                                <td>

                                    <div class="dropdown-info dropdown open">
                                        <button class="btn btn-info dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><li class="fa fa-gear fa-spin"></li></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

{{--                                            <a    href="{{route('Invoices.edit',$invoice->id)}}"--}}

{{--                                                 class="dropdown-item waves-light waves-effect" > <li class="icofont icofont-ui-edit"> Edit</li> </a>--}}
                          @can('invoice-delete')

                                            <a  class="dropdown-item waves-light waves-effect"  href="#delete_invoice"  data-id_invoice="{{$invoice->id}}" data-invoice_number ="{{$invoice->number}}"
                                                data-effect="effect-scale" data-toggle="modal" >
                    <li class="icofont icofont-trash"> Delete</li>  </a>
                                      @endcan

                                                
                          @can('invoice-archive-edit')

                                            <a  class="dropdown-item waves-light waves-effect" href="#resotre_invoice"  data-id_invoice="{{$invoice->id}}" data-invoice_number ="{{$invoice->number}}"
                                                data-effect="effect-scale" data-toggle="modal" >
                                                <li class="icofont icofont-result"> Restore</li>  </a>
                       @endcan
                          @can('invoice-show')

                                            <a  href="{{route('Invoices.show',$invoice->id)}}" class="dropdown-item waves-light waves-effect" > <li class="icofont icofont-eye"> Details</li></a>
                                                                   @endcan

{{--                                            <a  href="#edit_status" data-id_invoice="{{$invoice->id}}" data-invoice_number ="{{$invoice->number}}" data-status_invoice ="{{$invoice->status}}" data-effect="effect-scale" data-toggle="modal" class="dropdown-item waves-light waves-effect" > <li class="icofont icofont-arrow-right"> Status</li></a>--}}

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
                            <th>Number</th>
                            <th> Customer Name</th>
                            <th>Reservation Number</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Invoice Date</th>
                            <th>Operation</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                {{ $invoices->links('vendor.pagination.custom') }}

            </div>


        <!-- upload image -->

            <div class="modal fade" id="delete_invoice"  tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Invoice</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="add-form" action= "{{route('Archive_Invoices.destroy','delete')}}">
                                @csrf
                                {{method_field('delete')}}
                                <div class="form-group">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <h6 style="color:red" >Are you sure you want to delete the Invoice?</h6>

                                            <input type="hidden" name="id_operation" id="$id_operation" value="1">

                                            <input type="hidden" name="id_invoice" id="id_invoice" value="">

                                            <input type="text" disabled   name="invoice_number" value="" id="invoice_number" >

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
    <div class="modal fade" id="archive_invoice"  tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Archive Invoice</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="add-form" action= "{{route('Invoices.destroy','delete')}}">
                                @csrf
                                {{method_field('delete')}}
                                <div class="form-group">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <h6 style="color:red" >Are you sure you want to Archive the Invoice?</h6>


                                            <input type="hidden" name="id_invoice" id="id_invoice" value="">
                                            <input type="hidden" name="id_operation" id="id_operation" value="2">

                                            <input type="text" disabled   name="invoice_number" value="" id="invoice_number" >

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

            <div class="modal fade" id="resotre_invoice"  tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
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

                            <form method="POST" id="add-form" action= "{{route('Archive_Invoices.update','update')}}">
                                @csrf
                                {{ method_field('patch') }}
                                <div class="form-group">
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <h6 style="color:red" >Move the Invoice to the list Invoice?</h6>


                                            <input type="hidden" name="id_invoice" id="id_invoice" value="">

                                            <input type="text" disabled   name="invoice_number" value="" id="invoice_number" >

                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer float-center">
                                    <button type="submit" class="btn btn-danger float-right">Restore</button>

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
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_invoice = button.data('id_invoice')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id_invoice').val(id_invoice);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
        $('#resotre_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_invoice = button.data('id_invoice')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id_invoice').val(id_invoice);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>
@endsection

@endsection
