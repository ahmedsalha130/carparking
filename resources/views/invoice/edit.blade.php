@extends('layouts.app-dashboard')
@section('title')
Edit Invoice
@endsection
@php
    date_default_timezone_set("Asia/Gaza");

@endphp
@section('content')
    <style>
        form.form  label.error, label.error {

            color: #F00;
            font-style: italic;
        }
        .timepicker,.icons {

            background: #fff;
            color: #0a6aa1;
        }
    </style>
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4> Edit Invoice</h4>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item" style="float: left;">
                        <a href="../index.html"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Invoice</a>
                    </li>
                    <li class="breadcrumb-item" style="float: left;"><a href="#!">Edit</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    @include('layouts.flash')

    <div class="page-body">

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">Edit Invoice</h6>
                <div class="ml-auto">
                    <a  type="button" href="{{route('Invoices.index')}}"  data-effect="effect-scale"
                        class="btn btn-sm btn-primary waves-effect waves-light f-right" >
                        <i class="icofont icofont-home"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">

                <!-- row -->
                <div class="row">

                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('Invoices.update',$invoice->id) }}" id="myform" onsubmit="return myFunction()"  data-parsley-validate="" method="post"  enctype="multipart/form-data"
                                      autocomplete="off">
                                    {{ csrf_field() }}
                                    {{method_field('PATCH')}}

                                    {{-- 1 --}}

                                    <div class="row">


                                        <div class="col">
                                            <label>Invoice Date</label>
                                            <input class="form-control fc-datepicker" required name="invoice_date" readonly placeholder="YYYY-MM-DD"
                                                   type="text" value="{{old('invoice_date',$invoice->invoice_date)}}"  >
                                        </div>
                                        <div class="col mg-b-0" >
                                            <label for="due_date" class="control-label">Due Date </label>
                                            <input type="date" class="form-control" id="due_date"  value="{{old('due_date',$invoice->due_date)}}"   name="due_date"  >
                                        </div>
                                        <div class="col">
                                            <label>Invoice Status</label>
                                            <select required name="status" class="form-control SlectBox" >
                                                <!--placeholder-->
                                                <option value="" selected disabled>-----</option>

                                                <option selected ="@if($invoice->status==1){'selected'}else{''} @endif" value="1"> Paid</option>
                                                <option selected ="@if($invoice->status==0){'selected'}else{''} @endif" value="0"> unpaid</option>




                                            </select>
                                        </div>

                                    </div>

                                    {{-- 2 --}}



                                    <div class="row">
                                        <div class="col">
                                            <label for="customer" class="control-label">Customer Name</label>
                                            <select readonly required name="customer" class="form-control SlectBox" onclick="console.log($(this).val())"
                                                    onchange="console.log('change is firing')">
                                                <!--placeholder-->
                                                    <option  readonly value="{{old('customer',$invoice->customer->id)}}"> {{old('customer',$invoice->customer->name)}}</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="reservation_number" class="control-label">Reservation Number</label>
                                            <select   id="reservation_number"   required  name="reservation_number" class="form-control">
                                                <option  readonly value="{{old('customer',$invoice->reservation->id)}}"> {{old('customer',$invoice->reservation->number)}}</option>

                                            </select>
                                            {{--                                            <input type="text" id="test" name="test" readonly onchange="myFunction()" value="">--}}
                                        </div>



                                        <div class="col">
                                            <label for="reservation_duration" class="control-label">Reservation Duration </label>
                                            <input type="text"  required onchange="myFunction()" class="form-control form-control-lg" id="reservation_duration"
                                                   name="reservation_duration"  value="{{old('reservation_duration',$invoice->reservation->duration)}}" >
                                        </div>
                                    </div>


                                    {{-- 3 --}}

                                    <div class="row">

                                        <div class="col">
                                            <input type="hidden"  name="time_price" value="{{$payment->time_price}}" required class="form-control form-control-lg" id="time_price">

                                            <label for="reservation_value"  class="control-label">Reservation Value</label>
                                            <input type="text" readonly required onchange="myFunction()" class="form-control form-control-lg" id="reservation_value"
                                                   name="reservation_value" title="Reservation Value " value="{{old('reservation_value',$invoice->reservation_value)}}" >
                                        </div>
                                        <div class="col">
                                            <label for="amount_commission" class="control-label">Commission Amount</label>
                                            <input type="text" value="{{old('amount_commission',$invoice->amount_commission)}}" required onchange="myFunction()" class="form-control form-control-lg" id="amount_commission"
                                                   name="amount_commission" title="Commission Amount "
                                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            >
                                        </div>

                                        <div class="col">
                                            <label for="discount" class="control-label">Discount</label>
                                            <input type="text" required class="form-control form-control-lg" value="{{old('discount',$invoice->discount)}}" onchange="myFunction()" id="discount" name="discount"
                                                   title="Please Enter Discount value "
                                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                   value=0 >
                                        </div>



                                    </div>

                                    {{-- 4 --}}

                                    <div class="row">


                                        <div class="col">
                                            <label for="total" class="control-label">Total</label>
                                            <input type="text"  required class="form-control" value="{{old('total',$invoice->total)}} " id="total" name="total" readonly>
                                        </div>
                                    </div>

                                    {{-- 5 --}}
                                    <div class="row">
                                        <div class="col">
                                            <label for="exampleTextarea">Note</label>
                                            <textarea class="form-control" value="" id="note" name="note" rows="3">{{old('note',$invoice->note)}} </textarea>
                                        </div>
                                    </div><br>


                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@section('script')






    <script>
        function myFunction() {
            var amount_commission = parseFloat(document.getElementById("amount_commission").value);
            var discount = parseFloat(document.getElementById("discount").value);
                        var time_price = parseFloat(document.getElementById("time_price").value);

            var reservation_duration = document.getElementById("reservation_duration").value;
            var Amount_Commission2 = amount_commission - discount;
            var reservation_value2  = (time_price * reservation_duration) ; // 10$ => hour

            if (typeof amount_commission === 'undefined' || !amount_commission) {
                alert('Please enter the commission amount ');
            } else {
                var intResults = Amount_Commission2  / 100;
                var intResults2 = parseFloat( reservation_value2+intResults + Amount_Commission2);
                // sumq = parseFloat(intResults).toFixed(2);
                sumt = parseFloat(intResults2).toFixed(2);
                document.getElementById("reservation_value").value = reservation_value2;
                document.getElementById("total").value = sumt  ;
            }
        }
    </script>
@endsection
@endsection
