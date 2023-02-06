<?php

namespace App\Http\Controllers\BackendAdmin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ArchiveInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function __construct()
    {
        $this->middleware('permission:invoice-archive-list', ['only' => ['index']]);
        $this->middleware('permission:invoice-archive-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:invoice-archive-delete', ['only' => ['destroy']]);

    }

    public function index()
    {
        $invoices = Invoice::onlyTrashed()->paginate(10);

        return view('invoice.archive.index',compact('invoices'));
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
    public function update(Request $request, $id)
    {

        $invoice = Invoice::withTrashed()->find($request->id_invoice)->restore();


        if ($invoice) {


            session()->flash('archive_update', 'Invoice Restored successfully');

            return redirect()->route('Archive_Invoices.index')->with([
                'message' => 'Invoice Updated successfully',
                'alert-type' => 'success',
            ]);
        }else {
            session()->flash('error', 'Invoice  Not Restored ');

            return redirect()->route('Archive_Invoices.index')->with([
                'message' => 'Invoice Updated successfully',
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
        $id = $request->id_invoice;
        $invoice = Invoice::whereId($id)->onlyTrashed()->first();
        $reservation = Reservation::withTrashed()->where('id',$invoice->reservation_id)->first();


        $id_operation = $request->id_operation;

        if ($id_operation == 1) {

            if ($invoice) {

                $reservation->forceDelete();
                $invoice->forceDelete();


                session()->flash('delete', 'Invoice Deleted successfully');

                return redirect()->route('Archive_Invoices.index')->with([
                    'message' => 'Invoice Deleted successfully',
                    'alert-type' => 'success',
                ]);
            }else {
                session()->flash('error', 'Invoice Not Deleted');

            }

            return redirect()->back()->with([
                'message' => 'Something was wrong',
                'alert-type' => 'danger',
            ]);

        }
    }
}
