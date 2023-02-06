<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Park;
use App\Models\Invoice;
use App\Models\Reservation;
use Livewire\Component;
use DB ;

class Chat extends Component
{
    public $messageText;

    public function render()
    {
//        $messages = \App\Models\Chat::with('user')->latest()->take(10)->get()->sortBy('id');

//        return view('livewire.index', compact('messages'));


$invoice_paid = Invoice::where('status',0)->get();
        $invoice_unpaid = Invoice::where('status',1)->get();
        $paid_count = count($invoice_paid);
         $total_paid_invoice = DB::table('invoices')->where('status',1)->sum('total');
         $total_unpaid_invoice = DB::table('invoices')->where('status',0)->sum('total');
        $unpaid_count = count($invoice_unpaid);

        $invoices  = Invoice::with('customer')->orderBy('id','DESC')->take(5)->get();

        $chartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['Paid Invoices', 'Unpaid Invoices'])
            ->datasets([
                [
                    'backgroundColor' => ['#81b214', '#ec5858'],
                    'data' => [$unpaid_count, $paid_count]
                ]
            ])
            ->options([]);
            
        $customers = Customer::withTrashed()->orderBy('id','Desc')->take(4)->get();
        $parks = Park::orderBy('id','Desc')->take(4)->get();
        $reservations = Reservation::withTrashed()->with(['customers','intervals','parks'])->orderBy('id','Desc')->take(5)->get();
        $reservations_all = Reservation::withTrashed()->get();
        $busy_count = Reservation::where('status',2)->get();
        $reservation_count = Reservation::where('status',1)->get();
        $cancel_count = Reservation::where('status',0)->onlyTrashed()->get();
        $complement_count = Reservation::where('status',3)->onlyTrashed()->get();
        return view('livewire.chat',compact('busy_count','reservation_count'
            ,'cancel_count','complement_count','reservations','reservations_all','customers','parks','invoices','chartjs','total_paid_invoice','total_unpaid_invoice'));
    }

    public function sendMessage()
    {
        \App\Models\Chat::create([
            'user_id' => auth()->user()->id,
            'message_text' => $this->messageText,
        ]);

        $this->reset('messageText');
    }

    public function index()
    {
        $customers = Customer::latest()->take(10)->get()->sortBy('id');

        return view('livewire.index', compact('customers'));
    }


}
