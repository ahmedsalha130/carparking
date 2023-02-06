@extends('layouts.app-dashboard')
@section('title')
Show Invoice
@endsection
@section('content')
    <style>
        form.form  label.error, label.error {

            color: #F00;
            font-style: italic;
        }
    </style>
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>  Invoice Number: {{$invoice->number}}</h4>
                    <span></span>
                </div>
            </div>
        </div>

    </div>
    </div>
    @include('layouts.flash')

    <div class="page-body">




            <div class="container">

                <div>

                    <div  id="print" class="card">
                        <div class="row invoice-contact">
                            <div class="col-md-8">
                                <div class="invoice-box row">
                                    <div class="col-sm-12">
                                        <table class="table table-responsive invoice-table table-borderless">
                                            <tbody>
                                            <tr>
                                                <td><img src="{{asset('/files/assets/images/logo-blue.png')}}" class="m-b-10" alt=""></td>
                                            </tr>
                                            <tr>
                                                <td>Smart Car Parking System</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td><a  href="mailto: admin@carparking.tech" target="_top"><span class="__cf_email__" data-cfemail="2246474f4d62454f434b4e0c414d4f">admin@carparking.tech</span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Release Date :{{date('Y-m-d ')}}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="row invoive-info">
                                <div class="col-md-4   invoice-client-info">
                                    <h6>Client Information :</h6>
                                    <h6 class="m-0">{{$invoice->customer->name}}</h6>
                                    <p class="m-0">{{$invoice->customer->mobile}}</p>
                                    <p><a  href="mailto: {{$invoice->customer->email}}" target="_top"><span class="__cf_email__" data-cfemail="2246474f4d62454f434b4e0c414d4f">{{$invoice->customer->email}}</span></a>
                                    </p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <h6>Invoice Information :</h6>
                                    <table class="table table-responsive invoice-table invoice-order table-borderless">
                                        <tbody>
                                        <tr>
                                            <th>Date :</th>
                                            <td>{{$invoice->invoice_date}}</td>
                                        </tr>
                                        <tr>
                                            <th>Status :</th>
                                            @if($invoice->status() =='paid')

                                                <td><span class="label label-success"> {{$invoice->status()}}</span></td>
                                            @else
                                                <td><span class="label label-danger"> {{$invoice->status()}}</span></td>
                                                @endif
                                        </tr>
                                        <tr>
                                            <th>Due_date :</th>
                                            <td>
                                                {{$invoice->due_date}}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <h6 class="m-b-20">Invoice Number
                                        <span>#{{$invoice->number}}</span></h6>
                                    <h6 class="text-uppercase text-primary">Total Due :
                                        <span>${{$invoice->total}}</span>
                                    </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table  invoice-detail-table">
                                            <thead>
                                            <tr class="thead-default">
                                                <th>Reservation Number</th>
                                                <th>Interval</th>
                                                <th>Status</th>
                                                <th>Park Number</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Duration</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    {{$invoice->reservation->number}}
                                                </td>
                                                <td>
                                                    {{$invoice->reservation->intervals->start}}-{{$invoice->reservation->intervals->end}}
                                                </td>
                                                @if($invoice->reservation->status() =='reserved')

                                                    <td><span class="label label-success"> {{$invoice->reservation->status()}}</span></td>
                                                @elseif($invoice->reservation->status() =='canceled')
                                                    <td><span class="label label-danger"> {{$invoice->reservation->status()}}</span></td>
                                                @elseif($invoice->reservation->status()=='finished')
                                                    <td><span class="label label-info"> {{$invoice->reservation->status()}}</span></td>

                                                @else
                                                    <td><span class="label label-warning"> {{$invoice->reservation->status()}}</span></td>
                                                @endif

                                                <td>{{$invoice->reservation->parks->number}}</td>
                                                <td> {{$invoice->reservation->start_time_sensor}}</td>
                                                <td> {{$invoice->reservation->end_time_sensor}}</td>
                                                <td> {{$invoice->reservation->duration}}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-responsive invoice-table invoice-total">
                                        <tbody>
                                        <tr>
                                            <th>Reservation Value :</th>
                                            <td>${{$invoice->reservation_value}}</td>
                                        </tr>
                                        <tr>
                                            <th>Amount Commission  :</th>
                                            <td>${{$invoice->amount_commission}}</td>
                                        </tr>
                                        <tr>
                                            <th>Discount  :</th>
                                            <td>${{$invoice->discount}}</td>
                                        </tr>
                                        <tr class="text-info">
                                            <td>
                                                <hr />
                                                <h5 class="text-primary">Total :</h5>
                                            </td>
                                            <td>
                                                <hr />
                                                <h5 class="text-primary">${{$invoice->total}}</h5>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-12">--}}
{{--                                    <h6>Terms And Condition :</h6>--}}
{{--                                    <p>lorem ipsum dolor sit amet, consectetur adipisicing--}}
{{--                                        elit, sed do eiusmod tempor incididunt ut labore et--}}
{{--                                        dolore magna aliqua. Ut enim ad minim veniam, quis--}}
{{--                                        nostrud exercitation ullamco laboris nisi ut aliquip--}}
{{--                                        ex ea commodo consequat. Duis aute irure dolor </p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col-sm-12 invoice-btn-group text-center">
                            <button type="button" onclick="printDiv()" class="btn btn-primary btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20">Print</button>
                            <button type="button" class="btn btn-danger waves-effect m-b-10 btn-sm waves-light">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>


    </div>
    </div>

    <div id="styleSelector">
    </div>
    </div>



@section('script')



    <script>
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection

@endsection
