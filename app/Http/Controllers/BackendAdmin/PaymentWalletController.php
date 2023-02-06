<?php

namespace App\Http\Controllers\BackendAdmin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Interval;
use App\Models\Park;
use App\Models\PaymentWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class PaymentWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallets = PaymentWallet::with('customer')->get() ;
        $customers = Customer::get() ;

        return view ('paymentwallet.index',compact('wallets','customers'));

    }

    public function  PaymentWallet_active(){
        $wallets = PaymentWallet::where('status',1)->with('customer')->get() ;
        $customers = Customer::get() ;

        return view ('paymentwallet.active',compact('wallets','customers'));

    }
    public function  PaymentWallet_disactive(){
        $wallets = PaymentWallet::where('status',0)->with('customer')->get() ;
        $customers = Customer::get() ;

        return view ('paymentwallet.disactive',compact('wallets','customers'));

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
        $validator = Validator::make($request->all(), [
            'customer_name'          => 'required',
            'amount_value'        => 'required|numeric',
            'status'        => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['customer_id']           = $request->customer_name;
        $data['number']          = $data['number'] = Carbon::now()->timestamp;
        $data['amount']          = $request->amount_value;
        $data['status']         = $request->status;


        $wallet =PaymentWallet::create($data);

        if ($wallet){



            session()->flash('add', 'PaymentWallet Created successfully');

            return redirect()->route('PaymentWallet.index')->with([
                'message' => 'PaymentWallet Created successfully',
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
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'amount_value'        => 'required|numeric',
            'status'        => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $wallet = PaymentWallet::where('id',$request->id_wallet)->first();




        if ($wallet){
            $data['customer_id']           = $request->customer_id;
            $data['amount']          = $request->amount_value;
            $data['status']         = $request->status;


            $wallet->update($data);


            session()->flash('edit', 'PaymentWallet Updated successfully');

            return redirect()->route('PaymentWallet.index')->with([
                'message' => 'PaymentWallet Updated successfully',
                'alert-type' => 'success',
            ]);
        }
        session()->flash('error', 'Something was wrong');

        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }
    public function PaymentWallet_status(Request $request)
    {

        $id = $request->id_wallet;
        $wallet = PaymentWallet::find($id)->first();
        if ($wallet) {

            $wallet->update(['status'=>$request->status ]);
                session()->flash('edit', 'PaymentWallet  Status Updated successfully');

                return redirect()->route('PaymentWallet.index')->with([
                    'message' => 'PaymentWallet Status Updated successfully',
                    'alert-type' => 'success',
                ]);
            }


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request)
    {
        $id = $request->id_wallet ;
        $wallet =PaymentWallet::where('id',$id)->first();

        $id_operation = $request->id_operation ;

        if ($id_operation == 1){

            if ($wallet) {

                $wallet->forceDelete();

                session()->flash('delete', 'PaymentWallet Deleted successfully');

                return redirect()->route('PaymentWallet.index')->with([
                    'message' => 'PaymentWallet Deleted successfully',
                    'alert-type' => 'success',
                ]);

                session()->flash('error', 'PaymentWallet Not Deleted');


            }else {
                return redirect()->back()->with([
                    'message' => 'Something was wrong',
                    'alert-type' => 'danger',
                ]);
            }

        }else {


            if ($wallet) {

                $wallet->delete();

                session()->flash('archive', 'The PaymentWallet has been successfully moved to the archive');

                return redirect()->route('PaymentWallet.index')->with([
                    'message' => 'The PaymentWallet has been successfully moved to the archive',
                    'alert-type' => 'success',
                ]);
            }
            session()->flash('error', 'Something was wrong');

            return redirect()->back()->with([
                'message' => 'Something was wrong',
                'alert-type' => 'danger',
            ]);
        }

    }
}
