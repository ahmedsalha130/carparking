<?php

namespace App\Http\Controllers\BackendAdmin;

use App\Http\Controllers\Controller;
use App\Models\PaymentWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
       public function __construct()
    {
        $this->middleware('permission:payment-list', ['only' => ['index']]);
        $this->middleware('permission:payment-create', ['only' => ['create','store']]);
        $this->middleware('permission:payment-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:payment-delete', ['only' => ['destroy']]);

    }
    public function index()
    {

        $wallets = PaymentWallet::all();


        return  view('Payment.index',compact('wallets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'time_price' => 'required',
            'amount_commission' => 'required|nullable',
            'discount' => 'required|nullable',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }




        $payment = PaymentWallet::where('id',$request->id_wallet)->first();

        if ($payment){

            $data['time_price']           = $request->time_price     ;
            $data['amount_commission']           = $request->amount_commission;
            $data['discount']         = $request->discount;

            $payment->update($data);
            session()->flash('edit', 'Payment Updated successfully');

            return redirect()->route('Payment.index')->with([
                'message' => 'Payment Updated successfully',
                'alert-type' => 'success',
            ]);
        }
        session()->flash('error', 'Something was wrong');

        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
