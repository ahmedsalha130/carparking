<?php

namespace App\Http\Controllers\Frontend;

use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Custromer;
use App\Models\Reservation;
use App\Models\Invoice;
use App\Models\Interval;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

        $this->middleware('auth');
            $this->middleware('permission:customer-list', ['only' => ['index']]);
    $this->middleware('permission:customer-export', ['only' => ['export']]);
    $this->middleware('permission:customer-create', ['only' => ['create','store']]);
    $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    $this->middleware('permission:customer-show', ['only' => ['show']]);
    $this->middleware('permission:customer-active-dis', ['only' => ['disactive_customer','active_customer']]);
    }
    public function index()
    {       $customers = Customer::orderby('created_at','desc')->paginate(10);
    return view('customer.auth.index',compact('customers'));
    }
 public function export()
    {
        return Excel::download(new CustomerExport(), 'customers.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.auth.create');

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
            'name'          => 'required',
            'email'         => 'required|email|max:255|unique:customers',
            'mobile'        => 'required|numeric|unique:customers',
            'status'        => 'required',
            'password'      => 'required|min:8|confirmed',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']           = $request->name;
        $data['email']          = $request->email;
        $data['email_verified_at'] = Carbon::now();
        $data['mobile']         = $request->mobile;
        $data['password']       = bcrypt($request->password);
        $data['status']         = $request->status;
        $data['near']            = $request->near;

        if ($customer_image = $request->file('customer_image')) {
            $filename = Str::slug($request->name).'.'.$customer_image->getClientOriginalExtension();
            // $path = public_path('files/assets/customer/'. $filename);
            $path = public_path('uploads/'.$filename);

            Image::make($customer_image->getRealPath())->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $data['customer_image']  = $filename;
        }

        $customer = Customer::create($data);

        if ($customer){


        session()->flash('add', 'Customer Created successfully');

        return redirect()->route('customer.index')->with([
            'message' => 'Customer Created successfully',
            'alert-type' => 'success',
        ]);
        }
        session()->flash('error', 'Customer Created successfully');

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
        $customer = Customer::find($id);
        $reservations = Reservation::where('customer_id',$id)->with(['intervals','parks'])->withTrashed()->paginate(10);
        return  view('customer.auth.show',compact('customer','reservations'));
    }
    public function Print($id)
    {
        $customer = Customer::find($id)->first();


        return view('customer.auth.show',compact('customer'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $customer = Customer::find($id);

       return view('customer.auth.edit',compact('customer'));
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
            'name'          => 'required',
            'email'         => 'required|email|max:255|unique:customers,email,'.$id,
            'mobile'        => 'required|numeric|unique:customers,mobile,'.$id,
            'status'        => 'required',
            'password'      => 'nullable|min:8',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $customer = Customer::whereId($id)->first();

        if ($customer) {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['mobile'] = $request->mobile;
            if (trim($request->password) != '') {
                $data['password'] = bcrypt($request->password);
            }
            $data['status'] = $request->status;
            $data['near'] = $request->near;

            if ($customer_image = $request->file('customer_image')) {
                if ($customer->customer_image != '') {
                    if (File::exists('uploads/'. $customer->customer_image)) {
                        unlink('uploads/'. $customer->customer_image);
                    }
                }
                $filename = $id . '.' . $customer_image->getClientOriginalExtension();
                $path = public_path('uploads/'.$filename);
                Image::make($customer_image->getRealPath())->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $data['customer_image'] = $filename;
            }

            $customer->update($data);

            if ($customer) {


                session()->flash('edit', 'Customer Updated successfully');

                return redirect()->route('customer.index')->with([
                    'message' => 'Customer Updated successfully',
                    'alert-type' => 'success',
                ]);
            }
            session()->flash('error', 'Customer  Not Updated !!');

            return redirect()->back()->with([
                'message' => 'Something was wrong',
                'alert-type' => 'danger',
            ]);
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id_customer ;
        $customer = Customer::whereId($id)->first();

        $id_operation = $request->id_operation ;

        if ($id_operation == 1){

            if ($customer) {
                if ($customer->customer_image != '') {
                    if (File::exists('uploads/'. $customer->customer_image)) {
                        unlink('uploads/'. $customer->customer_image);
                    }
                }

                 $invoices = Invoice::where('customer_id',$id)->withTrashed()->get();
                    foreach($invoices as $i ){

                         $i->forceDelete();
                    }

                $res = Reservation::where('customer_id',$id)->withTrashed()->get();
                foreach($res as $r){

                 if($r->status == 1 || $r->status == 2){

                        $current_interval = Interval::where('id',$r->interval_id)->first();

                        $current_interval_count = ($current_interval->count)+1;
                        $current_interval->update(['count' => $current_interval_count]);
                                         $r->forceDelete();

                 } else {

                     $r->forceDelete();

                 }



                }

                $customer->forceDelete();

                if ($customer) {



                    session()->flash('delete', 'Customer Deleted successfully');

                    return redirect()->route('customer.index')->with([
                        'message' => 'Customer Deleted successfully',
                        'alert-type' => 'success',
                    ]);
                }
                session()->flash('error', 'Customer Not Deleted');

                return redirect()->back()->with([
                    'message' => 'Something was wrong1',
                    'alert-type' => 'danger',
                ]);
            }else{
                  session()->flash('error', 'Customer Not Deleted');

                return redirect()->back()->with([
                    'message' => 'Something was wrong1',
                    'alert-type' => 'danger',
                ]);
            }

        }else {

                if ($customer) {


                $invoices = Invoice::where('customer_id',$id)->get();
                $res = Reservation::where('customer_id',$id)->get();
                 if($res && $invoices){

                    foreach($invoices as $i ){

                         $i->delete();
                    }



                foreach($res as $r){

                 if($r->status == 1 || $r->status == 2){

                        $current_interval = Interval::where('id',$r->interval_id)->first();

                        $current_interval_count = ($current_interval->count)+1;
                        $current_interval->update(['count' => $current_interval_count]);
                                         $r->delete();

                 } else {

                         $current_interval = Interval::where('id',$r->interval_id)->first();

                        $current_interval_count = ($current_interval->count)+1;
                        $current_interval->update(['count' => $current_interval_count]);
                                         $r->delete();

                 }
                }



                }

                    $customer->delete();

                    session()->flash('archive', 'The Customer has been successfully moved to the archive');

                    return redirect()->route('customer.index')->with([
                        'message' => 'The Customer has been successfully moved to the archive',
                        'alert-type' => 'success',
                    ]);
                }
                session()->flash('error', 'Something was wrong');

                return redirect()->back()->with([
                    'message' => 'Something was wrong2',
                    'alert-type' => 'danger',
                ]);
            }



    }

    public function active_customer(){

        $customers = Customer::where('status','1')->orderby('created_at','desc')->paginate(10);
        return view('customer.active_customer.index',compact('customers'));
    } public function disactive_customer(){

        $customers = Customer::where('status','0')->orderby('created_at','desc')->paginate(10);
        return view('customer.disactive_customer.index',compact('customers'));
    }

    public function remove_image(Request $request)
    {


        $customer = Customer::whereId($request->customer_id)->first();
        if ($customer) {
            if (File::exists('uploads/'. $customer->customer_image)) {
                unlink('uploads/'. $customer->customer_image);
            }
            $customer->customer_image = null;
            $customer->save();
            return 'true';
        }
        return 'false';
    }
}
