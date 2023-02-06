<?php

namespace App\Http\Controllers\Api\Invoice;
use Illuminate\Support\Facades\Validator;
use App\Models\PaymentWallet;

use App\Http\Controllers\Api\Customer\ApiResponses;
use App\Http\Controllers\Controller;
use App\Models\Invoice;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{       use ApiResponses;
    public function  paid ($customer_id){

        $invoice = Invoice::where('customer_id',$customer_id)->where('status',1)->get();
        $msg =['ok'];
        if ($invoice){

            return $this->apiResponse($invoice,$msg,200);

        }else {

            return $this->apiResponse($invoice,"Not Found Invoices",404);

        }


    }

    public function unpaid ($customer_id){

        $invoice = Invoice::where('customer_id',$customer_id)->where('status',0)->with('reservation')->get();
        $msg =['ok'];


        if ($invoice){

            return $this->apiResponse($invoice,$msg,200);

        }else {

            return $this->apiResponse($invoice,"Not Found Invoices",404);

        }
    }

    public function update_invoice ($customer_id){

        $invoices = Invoice::where('customer_id',$customer_id)->get();
        

        if ($invoices != null ){
                

              foreach ($invoices as $invoice){
            $invoice->update(['status'=>1]);

        }


            return $this->apiResponse($invoice,"Updated Status Invoices",200);

        }else {

            return $this->apiResponse("Null","Not Found Invoices",404);

        }
    }

    // payment

     public function  payment( Request  $request) {

        $validator = Validator::make($request->all(), [
            'total_profit'          => 'required|numeric',

        ]);
        if($validator->fails()) {
            return $this->apiResponse('Null',$validator->errors(),401);
        }
        $payment = PaymentWallet::first();

        $payment->total_profit += $request->total_profit ;
        $payment->save() ;


        if ($payment){

            return $this->apiResponse($payment,'Amount has  been added',200);

        }else {

            return $this->apiResponse($payment,"Amount has not been added",404);

        }

    }
 
    public function downloadPDF($id) {

        $invoice = Invoice::where('id',$id)->with(['customer','reservation'])->first();

        $pdf = Pdf::loadView('invoice.pdf', compact('invoice'));

        if ($pdf){

            return $pdf->download('invoice.pdf');

        }else {

            return $this->apiResponse("Null","Invoice Not Download",404);

        }

    }
    
    
}
