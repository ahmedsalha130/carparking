<?php

namespace App\Console\Commands;

use App\Mail\ChatCustomer;
use App\Models\Chat;
use App\Models\Customer;
use App\Models\Interval;
use App\Models\Reservation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ReservationStatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Status after hour 12';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
   public function handle()
    {
        $reservations = Reservation::where('status',1)->get();

        foreach ($reservations as $reservation){
            $data['sent_message']           = 'The reservation was terminated by the system due to the expiration of the reservation period, and a commission was deducted and recorded as an unpaid invoice';
            $data['customer_id']           = $reservation->customer_id;
            $data['status']           = 1;




            $chat = Chat::create($data);

            $customer = Customer::whereId($reservation->customer_id)->first();


            Mail::to($customer->email)->locale('Support Car Parking System')->send(new ChatCustomer($customer, $data['sent_message']  ));
            $current_interval = Interval::find($reservation->interval_id);
            $current_interval_count = ($current_interval->count)+1;
            $current_interval->update(['count' => $current_interval_count]);
            $reservation->update(['status'=>0]);
            $reservation->delete();
        }

    }
}
