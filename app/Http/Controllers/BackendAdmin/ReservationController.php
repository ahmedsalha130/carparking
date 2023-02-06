<?php

namespace App\Http\Controllers\BackendAdmin;

use App\Exports\ReservationExport;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Interval;
use App\Models\Park;
use App\Models\Invoice;
use App\Models\PaymentWallet;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ReservationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function __construct()
    {
        $this->middleware('permission:reservation-list', ['only' => ['index']]);
        $this->middleware('permission:reservation-export', ['only' => ['export']]);
        $this->middleware('permission:reservation-create', ['only' => ['create','store']]);
        $this->middleware('permission:reservation-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:reservation-delete', ['only' => ['destroy']]);
        $this->middleware('permission:reservation-show', ['only' => ['show']]);
        $this->middleware('permission:reservation-status', ['only' => ['reservation_status']]);
        $this->middleware('permission:reservation-busy', ['only' => ['busy']]);
    }

    public function index()
    {
        $reservations = Reservation::with(['customers', 'parks', 'intervals'])->paginate(10);
        $statuss = Reservation::get()->pluck('status');
        $customers = Customer::where('status', 1)->get();
        $intervals = Interval::where('status', 1)->where('count', '>=', '1')->get();
        $parks = Park::where('status', 1)->get();

        return view('reservation.index', compact('reservations', 'intervals', 'customers', 'parks', 'statuss'));
    }
        public function export()
    {
        return Excel::download(new ReservationExport(), 'reservations.xlsx');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Gaza");

        $validator = Validator::make($request->all(), [
            'interval_id' => 'required',
            'customer_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $park_id = Park::first()->id;

        $reservation_check = Reservation::where('interval_id', '=', $request->interval_id)->where('park_id', '=', $park_id)->exists();
        if (!$reservation_check) {
            $data['status'] = 1;
            $data['customer_id'] = $request->customer_id;
            $interval = Interval::find($request->interval_id);
            $interval_count = ($interval->count) - 1;
            $interval->update(['count' => $interval_count]);
            $data['interval_id'] = $request->interval_id;
            $data['park_id'] = $park_id;
            $data['number'] = Carbon::now()->timestamp;


            $reservation = Reservation::create($data);


            $this->create_invoice($request->customer_id,Carbon::now()->timestamp);


        } else {

            $data['status'] = 1;
            $data['customer_id'] = $request->customer_id;


            $array = [];
            $res = Reservation::where('interval_id', '=', $request->interval_id)->get();
            foreach ($res as $re) {
                array_push($array, $re->park_id);
            }

            $park_new_id = Park::whereNotIn('id', $array)->first();
            if ($park_new_id) {

//              $reservation_check = Reservation::where('interval_id','=',$request->interval_id)->where('park_id','=',$park_new_id)->get();
                $data['status'] = 1;
                $data['customer_id'] = $request->customer_id;
                $interval = Interval::find($request->interval_id);
                $interval_count = ($interval->count) - 1;
                $interval->update(['count' => $interval_count]);
                $data['interval_id'] = $request->interval_id;
                $reservationRecord = Reservation::latest()->first();
                if ($reservationRecord != null) {
                    $data['number'] = ($reservationRecord->id) + 1. . date('ymd');

                } else {

                    $data['number'] = 1. . date('ymd');

                }
                $data['park_id'] = $park_new_id->id;
                $data['number'] = Carbon::now()->timestamp;

                $reservation = Reservation::create($data);
                $this->create_invoice($request->customer_id,Carbon::now()->timestamp);



            }
        }


        if ($reservation) {


            session()->flash('add', 'reservation Created successfully');

            return redirect()->route('reservation.index')->with([
                'message' => 'reservation Created successfully',
                'alert-type' => 'success',
            ]);

        }

        session()->flash('error', 'Something was wrong');

        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function  create_invoice($customer_id,$number) {

        $payment = PaymentWallet::first();
        $data['number']           = Carbon::now()->timestamp;
        $data['invoice_date']          = date('Y-m-d') ;
        $data['status']          =0 ;
        $data['reservation_value']  =0 ;
        $discount = $payment->discount;
        $amount_commission = $payment->amount_commission;
        $result_1 = $amount_commission - $discount ;
        $result_2 = $result_1 /100;
        $data['amount_commission'] = $amount_commission;
        $data['total'] = $result_1+ $result_2;
        $data['discount'] = $discount;
        $data['customer_id'] = $customer_id;

        $reservation  = Reservation::where('customer_id',$customer_id)->where('number',$number)->first()->id;
        $data['reservation_id'] = $reservation;


        $invoice = Invoice::create($data);

    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function busy(){
        $reservations = Reservation::where('status',2)->with(['customers', 'parks', 'intervals'])->paginate(10);
        $statuss = Reservation::get()->pluck('status');
        $customers = Customer::where('status', 1)->get();
        $intervals = Interval::where('status', 1)->where('count', '>=', '1')->get();
        $parks = Park::where('status', 1)->get();

        return view('reservation.busy.index', compact('reservations', 'intervals', 'customers', 'parks', 'statuss'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'interval_id' => 'required',
            'customer_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = $request->id_reservation;
        $reservation = Reservation::whereId($id)->first();


        $park_id = Park::first()->id;

        $reservation_check = Reservation::where('interval_id', '=', $request->interval_id)->where('park_id', '=', $park_id)->exists();
        if (!$reservation_check) {
            $data['status'] = 1;
            $data['customer_id'] = $request->customer_id;
            $data['park_id'] = $park_id;

            //update current time



            $reservation_current = Reservation::whereId($id)->first();

            if ($request->interval_id == $reservation_current->interval_id ) {

                $data['interval_id'] = $request->interval_id ;
            }else
            {
                $current_interval = Interval::whereId($reservation_current->interval_id)->first();
                $current_interval_count = ($current_interval->count) +1 ;
                $current_interval->update(['count'=>$current_interval_count]);

                if($current_interval)
                {
                    $new_interval = Interval::whereId($request->interval_id)->first();
                    $new_interval_count = ($new_interval->count) -1 ;
                    $new_interval->update(['count'=>$new_interval_count]);
                    $data['interval_id'] = $request->interval_id ;

                }

            }






            $reservation->update($data);


        } else {
            $data['status'] = 1;
            $data['customer_id'] = $request->customer_id;


            $array = [];
            $res = Reservation::where('interval_id', '=', $request->interval_id)->get();
            foreach ($res as $re) {
                array_push($array, $re->park_id);
            }

            $park_new_id = Park::whereNotIn('id', $array)->first();
            if ($park_new_id) {
                $data['status'] = 1;
                $data['customer_id'] = $request->customer_id;


                //update current time
                $reservation_current = Reservation::whereId($id)->first();

                if ($request->interval_id == $reservation_current->interval_id ) {

                    $data['interval_id'] = $request->interval_id ;
                }else
                {
                    $current_interval = Interval::whereId($reservation_current->interval_id)->first();
                    $current_interval_count = ($current_interval->count) +1 ;
                    $current_interval->update(['count'=>$current_interval_count]);

                    if($current_interval)
                    {
                        $new_interval = Interval::whereId($request->interval_id)->first();
                        $new_interval_count = ($new_interval->count) -1 ;
                        $new_interval->update(['count'=>$new_interval_count]);
                        $data['interval_id'] = $request->interval_id ;

                    }
                }





                $data['park_id'] = $park_new_id->id;


                $reservation->update($data);


            }
        }


        if ($reservation) {


            session()->flash('edit', 'reservation Updated successfully');

            return redirect()->route('reservation.index')->with([
                'message' => 'reservation Created successfully',
                'alert-type' => 'success',
            ]);

        }





    }

    public function reservation_status(Request $request)
    {

        $id = $request->id_reservation;
        $reservation = Reservation::whereId($id)->first();
        if ($reservation) {


            if ($request->status ==0 ){

                $data['status'] = $request->status;
                $reservation->update($data);
                $interval_id = Reservation::where('id',$id)->first();
                $current_interval = Interval::where('id',$interval_id->interval_id)->first();
                $current_interval_count = ($current_interval->count)+1;
                $current_interval->update(['count' => $current_interval_count]);

                $reservation->delete();

                session()->flash('archive', 'The Reservation has been successfully moved to the archive');

                return redirect()->route('reservation_archive.index')->with([
                    'message' => 'The Reservation has been successfully moved to the archive',
                    'alert-type' => 'success',
                ]);
            } elseif ($request->status ==3) {



                    $data['status'] = $request->status;
                    $reservation->update($data);
                 $interval_id = Reservation::where('id',$id)->first();
                $current_interval = Interval::where('id',$interval_id->interval_id)->first();
                    $current_interval_count = ($current_interval->count)+1;
                    $current_interval->update(['count' => $current_interval_count]);

                    $this->update_invoice($reservation->duration,$reservation->customer_id,$id);

                    $reservation->delete();

                    session()->flash('archive', 'The Reservation has been successfully moved to the archive(finish)');

                    return redirect()->route('reservation_archive.index')->with([
                        'message' => 'The Reservation has been successfully moved to the archive finish',
                        'alert-type' => 'success',
                    ]);

            }
            else{
                $data['status'] = $request->status;

            }



            $reservation->update($data);
            session()->flash('edit', 'Status Updated successfully');

            return redirect()->route('reservation.index')->with([
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */



    public function  update_invoice(  $duration ,$customer_id,$reservation_id) {

//    $data['due_date']           = $request->due_date ;
//        $discount = floatval(0);
//        $amount_commission = floatval(0.50);
//        $result_1 = $amount_commission - $discount ;
//        $result_2 = $amount_commission /100 ;
//        $data['amount_commission'] = $amount_commission;
//        $data['discount'] = $discount;
        $invoice = Invoice::where('customer_id',$customer_id)->where('reservation_id',$reservation_id)->first();
        $invoice->reservation_value  = (0.167 * $duration) ;
        $invoice->total         +=   $invoice->reservation_value;

        $invoice->save();

    }




    public function destroy(Request $request)
    {
        $id = $request->id_reservation;
        $reservation = Reservation::where('id',$id)->first();

        if ($reservation) {
            $invoice = Invoice::where('reservation_id',$id)->first();
            $interval_id = Reservation::find($id)->first();
            $current_interval = Interval::find($interval_id->interval_id);
            $current_interval_count = ($current_interval->count)+1;
            $current_interval->update(['count' => $current_interval_count]);
            $invoice->forceDelete();
            $reservation->forceDelete();

            if ($reservation) {


                session()->flash('delete', 'Reservation Deleted successfully');

                return redirect()->route('reservation.index')->with([
                    'message' => 'reservation Deleted successfully',
                    'alert-type' => 'success',
                ]);
            }
            session()->flash('error', 'reservation Not Deleted');

            return redirect()->back()->with([
                'message' => 'Something was wrong',
                'alert-type' => 'danger',
            ]);
        }
    }
}
