<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Invoice Number : {{$invoice->number}}</title>


    <style>
        body {
            font-family: 'almarai', sans-serif;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            font-size: 9px;
            line-height: 24px;
            font-family: 'almarai', sans-serif;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: right;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td {
            text-align: left;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 30px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: 'almarai', sans-serif;
        }
        .rtl table {
            text-align: right;
        }
        .rtl table tr td {
            text-align: right;
        }
        @page {
            header: page-header;
            footer: page-footer;
        }
    </style>
</head>

<body>
<div class="invoice-box" >
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="6">
                <table>
                    <tr>
                        <td width ="65%" class="title">
                            <img src="https://i.postimg.cc/fJ1fY9rb/pngegg-20.png" style="width: 100%; max-width: 300px" />
                        </td>

                        <td width ="35%">
                            Number :{{ $invoice->number }} <br>
                            Date:{{ $invoice->invoice_date }} <br>
                            Date Print :{{ Carbon\Carbon::now()->format('Y-m-d') }} <br>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center" ><h2>Car parking System</h2></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="6">
                <table>
                    <tr>
                        <td width ="50%">
                            <h2> Customer Name</h2>
                            {{ $invoice->customer->name }}<br>
                            <span dir="ltr"> {{ $invoice->customer->mobile }}</span><br>
                            {{ $invoice->customer->email }}}
                        </td>
{{--                        <td width="50%">--}}
{{--                            <h2>Car parking System</h2>--}}

{{--                        </td>--}}
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">

            <td>Reservation Number</td>
            <td>Interval</td>
            <td>Park Number</td>
            <td>Status</td>
            <td>Start Time</td>
            <td>End Time</td>
            <td>Duration</td>
        </tr>

            <tr class="item ">
                <td>{{ $invoice->reservation->number }}</td>
                <td>  {{$invoice->reservation->intervals->start}}-{{$invoice->reservation->intervals->end}}</td>
                <td>{{$invoice->reservation->parks->number}}</td>

            @if($invoice->reservation->status() =='reserved')

                    <td><span class="label label-success"> {{$invoice->reservation->status()}}</span></td>
                @elseif($invoice->reservation->status() =='canceled')
                    <td><span class="label label-danger"> {{$invoice->reservation->status()}}</span></td>
                @elseif($invoice->reservation->status()=='finished')
                    <td><span class="label label-info"> {{$invoice->reservation->status()}}</span></td>

                    @else
                <td>{{$invoice->reservation->start_time_sensor}}</td>
                    <td> {{$invoice->reservation->end_time_sensor}}</td>
                    <td> {{$invoice->reservation->duration}}</td>
                @endif

            </tr>

        <tr class="total">
            <td colspan="4"></td>
            <td>Reservation Value :</td>
            <td>${{$invoice->reservation_value}}</td>
        </tr>

        <tr class="total">
            <td colspan="4"></td>
            <td>Amount Commission  :</td>
            <td>${{$invoice->amount_commission}}</td>
        </tr>
        <tr class="total">
            <td colspan="4"></td>
            <td>Discount :</td>
            <td>${{$invoice->discount}}</td>
        </tr>
        <tr class="total">
            <td colspan="4"></td>
            <td>Total :</td>
            <td>${{$invoice->total}}</td>
        </tr>


    </table>
</div>
</body>
</html>
