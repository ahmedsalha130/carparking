<?php

namespace App\Http\Controllers\BackendAdmin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\PaymentWallet;
use Illuminate\Http\Request;

class PaymentWalletArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallets = PaymentWallet::onlyTrashed()->with('customer')->get() ;
        $customers = Customer::get() ;
        return view ('paymentwallet.archive',compact('wallets','customers'));

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
        $wallet = PaymentWallet::withTrashed()->find($request->id_wallet)->restore();


        if ($wallet) {


            session()->flash('archive_update', 'PaymentWallet Restored successfully');

            return redirect()->route('PaymentWallet_Archive.index')->with([
                'message' => 'PaymentWallet Restored successfully',
                'alert-type' => 'success',
            ]);
        }else {
            session()->flash('archive_update', 'PaymentWallet Restored Failed ');

            return redirect()->route('PaymentWallet_Archive.index')->with([
                'message' => 'PaymentWallet Restored Failed',
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
    public function destroy(Request  $request)
    {
        $wallet = PaymentWallet::withTrashed()->where('id',$request->id_wallet)->first();



        if ($wallet) {

            $wallet->forceDelete();

            session()->flash('delete', 'PaymentWallet Deleted successfully');

            return redirect()->route('PaymentWallet_Archive.index')->with([
                'message' => 'PaymentWallet Deleted successfully',
                'alert-type' => 'success',
            ]);
        }else
        {
            session()->flash('error', 'PaymentWallet Not Deleted');

            return redirect()->back()->with([
                'message' => 'Something was wrong',
                'alert-type' => 'danger',
            ]);
        }


    }
}
