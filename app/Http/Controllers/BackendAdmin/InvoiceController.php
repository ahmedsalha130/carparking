<?php

namespace App\Http\Controllers\BackendAdmin;

use App\Exports\InvoiceExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Interval;
use App\Models\Invoice;
use App\Models\Park;
use App\Models\PaymentWallet;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
{
    $this->middleware('permission:invoice-list', ['only' => ['index']]);
    $this->middleware('permission:invoice-export', ['only' => ['export']]);
    $this->middleware('permission:invoice-create', ['only' => ['create','store']]);
    $this->middleware('permission:invoice-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:invoice-delete', ['only' => ['destroy']]);
    $this->middleware('permission:invoice-show', ['only' => ['show']]);
    $this->middleware('permission:invoice-status', ['only' => ['invoice_status']]);
    $this->middleware('permission:invoice-paid', ['only' => ['paid']]);
    $this->middleware('permission:invoice-unpaid', ['only' => ['unpaid']]);
    $this->middleware('permission:invoice-downloadPDF', ['only' => ['downloadPDF']]);
}
    public function index()
    {
        $invoices = Invoice::with(['customer','reservation'])->paginate(10);

        return view('invoice.index',compact('invoices'));
    }
      public function export()
    {
        return Excel::download(new InvoiceExport(), 'invoices.xlsx');
    }
    
    public function downloadPDF($id) {

        $invoice = Invoice::where('id',$id)->with(['customer','reservation'])->first();

        $pdf = Pdf::loadView('invoice.pdf', compact('invoice'));

        return $pdf->download('invoice.pdf');
    }

    public function paid(){
        $invoices = Invoice::where('status',1)->with(['customer','reservation'])->paginate(10);

        return view('invoice.paid.index',compact('invoices'));

    }
    public function unpaid(){
        $invoices = Invoice::where('status',0)->with(['customer','reservation'])->paginate(10);

        return view('invoice.unpaid.index',compact('invoices'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::get();
        $payment = PaymentWallet::first();

        return  view('invoice.create',compact('customers','payment'));
    }
    public function getpayments($id)
    {
        $reservations  =Reservation::where('customer_id',$id)->pluck('number','id');

        return json_encode($reservations);
    }

    public function getreservations($id)
    {

        $reservations = Reservation::where('customer_id',$id)->pluck('duration','id');

        return json_encode($reservations);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'customer' => 'required',
            'reservation_duration' => 'required:nullable',
            'amount_commission' => 'required|nullable',
            'reservation_value' => 'required|nullable',
//            'total_payment' => 'required|nullable',
            'total' => 'required|nullable',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['number']           = Carbon::now()->timestamp;
        $data['invoice_date']           = $request->invoice_date;
        $data['due_date']           = $request->due_date ;
        
        if($request->status ==1) {
        $data['status']           = $request->status;
        $payment = PaymentWallet::first();

        $payment->total_profit += $request->total;
        $payment->update(['total_profit'=>$payment->total_profit]);
        }else {
          $data['status']           = $request->status;
  
        }
        $data['reservation_value']         = $request->reservation_value;
        $data['amount_commission'] = $request->amount_commission;
        $data['discount'] = $request->discount;
        $data['payment_id']         = $request->total_payment;

//        $payment = PaymentWallet::whereId($request->total_payment)->first();
//        $amount =  $payment->amount  - $request->total  ;
//        $payment->amount = $amount ;
//        $payment->update(['amount'=>$payment->amount]);
        $data['total']         = $request->total;
        $data['note']            = $request->note;
        $data['customer_id']          = $request->customer;

        $reservation_id  = Reservation::where('customer_id',$request->customer)->first()->id;
        $data['reservation_id'] =$reservation_id;



        $invoice = Invoice::create($data);

        if ($invoice){

            session()->flash('add', 'invoice Created successfully');

            return redirect()->route('Invoices.index')->with([
                'message' => 'invoice Created successfully',
                'alert-type' => 'success',
            ]);
        }
        session()->flash('error', 'Something was wrong');

        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $invoice = Invoice::where('id',$id)->withTrashed()->with(['customer','reservation'])->first();


        return view('invoice.show',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $invoice = Invoice::where('id',$id)->with(['customer','reservation'])->first();
        $payment = PaymentWallet::first();

        

        return view('invoice.edit',compact('invoice','payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {



        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'customer' => 'required',
            'reservation_duration' => 'required:nullable',
            'amount_commission' => 'required|nullable',
            'reservation_value' => 'required|nullable',
//            'total_payment' => 'required|nullable',
            'total' => 'required|nullable',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }




        $invoice = Invoice::where('id',$id)->first();

        if ($invoice){

            $data['due_date']           = $request->due_date ;
            $data['status']           = $request->status;
            $data['reservation_value']         = $request->reservation_value;
            $data['amount_commission'] = $request->amount_commission;
            $data['discount'] = $request->discount;
//            $data['payment_id']         = $request->total_payment;


            $data['total']         = $request->total;
            $data['note']            = $request->note;
            $data['customer_id']          = $request->customer;

            $reservation  = Reservation::where('customer_id',$request->customer)->withTrashed()->first();
            $data['reservation_id'] =$reservation->id;
            $reservation->update(['duration'=>$request->reservation_duration]);
            $invoice->update($data);
            session()->flash('edit', 'invoice Updated successfully');

            return redirect()->route('Invoices.index')->with([
                'message' => 'invoice Created successfully',
                'alert-type' => 'success',
            ]);
        }
        session()->flash('error', 'Something was wrong');

        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }
    public function invoice_status(Request $request)
    {
        $id = $request->id_invoice;
        $invoice = Invoice::where('id',$id)->first();
        if ($invoice) {

            
            if($request->status_invoice ==1) {
                
            $data['status'] = $request->status_invoice;

            $payment = PaymentWallet::first();

        $payment->total_profit += $invoice->total;
        $payment->update(['total_profit'=>$payment->total_profit]);
        }
        
         $data['status'] = $request->status_invoice;

            $invoice->update($data);
            session()->flash('edit', 'Status Updated successfully');

            return redirect()->route('Invoices.index')->with([
                'message' => 'Status Updated successfully',
                'alert-type' => 'success',
            ]);
        }
        session()->flash('error', 'Something was wrong');

        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request)
    {       
        $id = $request->id_invoice;
        $invoice = Invoice::whereId($id)->first();

        $id_operation = $request->id_operation;

        if ($id_operation == 1) {

            if ($invoice) {
            
           
            
            
                $reservation = Reservation::where('id',$invoice->reservation_id)->withTrashed()->first();
                
          
             if($reservation->status == 0 ||$reservation->status == 3)    {
                 
                 
                $current_interval = Interval::where('id',$reservation->interval_id)->first();
             
                   $reservation->forceDelete();
                    $invoice->forceDelete();
 
               }else {
                   
                $current_interval = Interval::where('id',$reservation->interval_id)->first();
                $current_interval_count = ($current_interval->count)+1;
                $current_interval->update(['count' => $current_interval_count]);
                $reservation->forceDelete();
                $invoice->forceDelete(); 
                
               }
             
          



                session()->flash('delete', 'Invoice Deleted successfully');

                return redirect()->route('Invoices.index')->with([
                    'message' => 'Invoice Deleted successfully',
                    'alert-type' => 'success',
                ]);
            }else {
                session()->flash('error', 'Invoice Not Deleted');

            }

                return redirect()->back()->with([
                    'message' => 'Something was wrong1',
                    'alert-type' => 'danger',
                ]);

            }else {

            if ($invoice) {
                
                      
            
                $reservation = Reservation::where('id',$invoice->reservation_id)->withTrashed()->first();
                
          
             if($reservation->status == 0 ||$reservation->status == 3)    {
                 
                 
                $current_interval = Interval::where('id',$reservation->interval_id)->first();
             
                   $reservation->delete();
                    $invoice->delete();
 
               }else {
                   
                $current_interval = Interval::where('id',$reservation->interval_id)->first();
                $current_interval_count = ($current_interval->count)+1;
                $current_interval->update(['count' => $current_interval_count]);
                $reservation->delete();
                $invoice->delete(); 
                
               }


                session()->flash('archive', 'Transfer the invoice to the Archive');

                return redirect()->route('Invoices.index')->with([
                    'message' => 'Transfer the invoice to the',
                    'alert-type' => 'success',
                ]);
            }else {
                session()->flash('error', 'Failed Transfer the invoice to the Archive');

            }

            return redirect()->back()->with([
                'message' => 'Something was wrong',
                'alert-type' => 'danger',
            ]);
        }
        }
}

