@extends('layouts.app-dashboard')
@section('title')
Invoices
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
                    <h4>Invoices Management</h4>
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
                 @can('invoice-create')

                <a  type="button" href="{{route('Invoices.create')}}"  data-effect="effect-scale"
                    class="btn btn-sm btn-primary waves-effect waves-light f-right" >
                    Create New Invoice  <i class="icofont icofont-plus"></i>
                </a>
                 @endcan

                <br>
                @can('invoice-export')
                <a href="{{route('invoice.export')}}" class="btn btn-secondary btn-sm ml-auto"><i class="icofont icofont-file-excel"></i> Export Excel</a>
@endcan
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
                                         @can('invoice-edit')

                                            <a    href="{{route('Invoices.edit',$invoice->id)}}"

                                                 class="dropdown-item waves-light waves-effect" > <li class="icofont icofont-ui-edit"> Edit</li> </a>
                                                                        @endcan

                                             @can('invoice-downloadPDF')
   
                                            <a  class="dropdown-item waves-light waves-effect"  href="{{route('invoice.pdf',$invoice->id)}}"
                                                data-effect="effect-scale" >
                                                <li class="icofont icofont-file-pdf"> PDF</li>
                                            </a>
                       @endcan
                                        @can('invoice-delete')

                                            <a  class="dropdown-item waves-light waves-effect"  href="#delete_invoice"  data-id_invoice="{{$invoice->id}}" data-invoice_number ="{{$invoice->number}}"
                                                data-effect="effect-scale" data-toggle="modal" >
                                                <li class="icofont icofont-trash"> Delete</li>  </a>
                                             @endcan
                                             
                                      @can('invoice-archive-edit')

                                            <a  class="dropdown-item waves-light waves-effect" href="#archive_invoice" data-id_invoice="{{$invoice->id}}" data-invoice_number ="{{$invoice->number}}"
                                                data-effect="effect-scale" data-toggle="modal" >
                                                <li class="icofont icofont-archive"> Archive</li>  </a>
                                     @endcan
                                                              @can('invoice-show')

                                            <a  href="{{route('Invoices.show',$invoice->id)}}" class="dropdown-item waves-light waves-effect" > <li class="icofont icofont-eye"> Details</li></a>
                                                                   @endcan
                  @can('invoice-status')

                                            <a  href="#edit_status" data-id_invoice="{{$invoice->id}}" data-invoice_number ="{{$invoice->number}}" data-status_invoice ="{{$invoice->status}}" data-effect="effect-scale" data-toggle="modal" class="dropdown-item waves-light waves-effect" > <li class="icofont icofont-arrow-right"> Status</li></a>
                       @endcan

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

                            <form method="POST" id="add-form" action= "{{route('Invoices.destroy','delete')}}">
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
            <!-- Edit Status -->
            <div class="modal fade" id="edit_status"  tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Status Invoice</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" id="add-form" action= "{{route('admin.invoice_status','status')}}">
                                @csrf
                                {{method_field('PATCH')}}
                                <div class="form-group">
                                    <div class="file-field input-field">
                                        <div class="btn">

                                            <input type="hidden" readonly required name="id_invoice"  class="form-control" id="id_invoice">
                                            <label for="number_reservation" class="col-form-label">No.Invoice</label>

                                            <input type="text" disabled   name="invoice_number" value="{{old('invoice_number')}}" id="invoice_number" >

                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status_invoice" class="col-form-label">Status Type</label>
                                    <select  name="status_invoice" id="status_invoice"  required  class="form-control">
                                        <option    value="1">Paid</option>
                                        <option    value="0" >Unpaid</option>
                                    </select>
                                    @error('status_invoice')
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
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_invoice = button.data('id_invoice')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id_invoice').val(id_invoice);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
        $('#archive_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_invoice = button.data('id_invoice')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id_invoice').val(id_invoice);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })

        $('#edit_status').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_invoice = button.data('id_invoice')
            var invoice_number = button.data('invoice_number')
            var status_invoice = button.data('status_invoice')

            var modal = $(this)
            modal.find('.modal-body #id_invoice').val(id_invoice);
            modal.find('.modal-body #invoice_number').val(invoice_number);
            modal.find('.modal-body #status_invoice').val(status_invoice);
        })

        $("#status_invoice").on("change", function () {
            $modal = $('#edit_status');
            if($(this).val() === 0){
                $modal.modal('hide');

            }
        });
    </script>
@endsection

@endsection
