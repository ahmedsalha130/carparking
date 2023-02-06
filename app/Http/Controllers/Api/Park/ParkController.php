<?php

namespace App\Http\Controllers\Api\Park;

use App\Http\Controllers\Api\Customer\ApiResponses;
use App\Http\Controllers\Controller;
use App\Models\Interval;
use App\Models\Customer;
use App\Models\Park;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParkController extends Controller
{
    use ApiResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parks = Park::get();
        $msg =['ok'];

        return $this->apiResponse($parks,$msg,200);
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
    public function  multi_get_near_renumber_park_number($customer_id){

    $all_near_customer = Customer::where('near',1)->get()->first();

            if($all_near_customer) {

                 $customer = Customer::where('id',$customer_id)->where('near',1)->first() ;

                 if($customer){
                         $reservation = Reservation::where('customer_id',$customer->id)->first();

                          if($reservation){

                                    $park= Park::where('id',$reservation->park_id)->first();
                                    if($park){

                                        return $this->apiResponse(['all-near-customer'=>$all_near_customer,'reservation-number'=>$reservation->number,'park-number'=>$park->number],'The date get',201);

                                    }else{

                                        return $this->apiResponse(0,"Not Found Park ",404);

                                    }

                          }else {

                             return $this->apiResponse(0,"Not Found Reservation ",404);

                          }

                         $park= Park::where('id',$reservation->park_id)->first();


                 }else{
                                return $this->apiResponse(0,"Not Found Customer ",404);

                 }

        }else {

           return $this->apiResponse(0,"Not Found Near = 1",404);

        }

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
            'name'          => 'required|unique:parks',
            'number'        => 'required|numeric|unique:parks',
            'status'        => 'required',
        ]);
        if($validator->fails()) {
            return $this->apiResponse('Null',$validator->errors(),401);
        }

        $data['name']           = "PR-".$request->name;
        $data['number']          = $request->number;
        $data['start_time_sensor'] =$request->start_time_sensor;
        $data['end_time_sensor'] = $request->end_time_sensor;
        $data['status']         = $request->status;
        $data['note']            = $request->note;


        $park = Park::create($data);

        if ($park){

            $interval_get = Interval::get();


            foreach ($interval_get as $interval ){
                $interval->id;
                $interval = Interval::find($interval->id)->update(['count'=>$interval->count+1]);


            }

            return $this->apiResponse($park,'The Park Save',201);



        }else {
            return $this->apiResponse('Null',"The Park Not Save",400);


        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $park = Park::where('number',$id)->first();
        $msg = ["ok"];

        if($park){

            return $this->apiResponse( $park,$msg,200);


        }else{
            return $this->apiResponse('Null',"The Data Not Found",401);


          }
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
            // 'name'          => 'required',
            // 'number'        => 'required|numeric|unique:parks,number,'.$id,
            'status'        => 'required',
            //   'start_time_sensor'        => 'required',
            //     'end_time_sensor'        => 'required',

        ]);
        if($validator->fails()) {
            return $this->apiResponse('Null',$validator->errors(),401);
        }




        // $park = Park::find($id);
         $park = Park::where('number',$id)->first();


        if (!$park){

            return $this->apiResponse('Null',"The Park is Not Found",400);






        }else{

        $data['name']           = $park->name;
        $data['number']          = $park->number;
        $data['start_time_sensor'] =$request->start_time_sensor;
        $data['end_time_sensor'] = $request->end_time_sensor;
        $data['status']         = $request->status;
        $data['note']            = $request->note;
        $park->update($request->all());

        if($park){

            return    $this->apiResponse( $park,'The Park is updated',200);

        }else {

            return  $this->apiResponse("Null",'The Park is Not Updated',401);
        }
        }
    }

     public function get_all_near (){

        $customer = Customer::where('near',1)->get()->first();

        if($customer) {

             return  $this->apiResponse($customer,'near active Successfully',200);

        }else {

           return $this->apiResponse(0,"Not Found Near = 1",404);

        }
    }

     public function update_near_park (Request $request,$id){

            $validator = Validator::make($request->all(), [
            'near' => 'required',
        ]);


              if ($validator->fails()) {


                  return $this->apiResponse('Null',$validator->errors(),401);

              }



        $customer = Customer::whereId($id)->first();



        if($customer) {

            $customer->update(['near'=>$request->near]);
             return  $this->apiResponse($customer,'Updated Successfully',200);

        }else {

           return $this->apiResponse('Null',"Not Found Near = 1",404);

        }
    }


     public function update_near_customer (Request $request,$id){

            $validator = Validator::make($request->all(), [
            'near' => 'required',
        ]);


              if ($validator->fails()) {


                  return $this->apiResponse('Null',$validator->errors(),401);

              }



        $customer = Customer::whereId($id)->first();



        if($customer) {

            $customer->update(['near'=>$request->near]);
             return  $this->apiResponse($customer,'Updated Successfully',200);

        }else {

           return $this->apiResponse('Null',"Not Found Near = 1",404);

        }
    }


     public function get_park_number ($number_reservation){

       $reservation = Reservation::where('number',$number_reservation)->first();
        $park_number = Park::where('id',$reservation->park_id)->first();


        if( isset($park_number)) {

             return  $this->apiResponse($park_number->number,' Successfully',200);

        }else {

           return $this->apiResponse('Null',"Not Found Park Number",404);

        }
    }

    public function get_resnumber_near($id){

              $customer = Customer::where('id',$id)->where('near',1)->first() ;


              if($customer){
                 $reservation = Reservation::where('customer_id',$customer->id)->first();

                   if($reservation) {

             return  $this->apiResponse($reservation->number,' Successfully',200);

        }else {

           return $this->apiResponse('Null',"Not Found  Number",404);

        }

        }else {
                             return $this->apiResponse('Null',"Not Found  Number",404);

              }


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
