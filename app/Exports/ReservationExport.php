<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReservationExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  Reservation::select('number',
            'number',
            'status',
            'start_time_sensor',
            'end_time_sensor',
            'duration',
        )->get();


    }

    public function headings(): array
    {
        return [
            '#',
            'Status',
            'Start Time Sensor',
            'End Time Sensor',
            'Duration',
        ];
    }
}
