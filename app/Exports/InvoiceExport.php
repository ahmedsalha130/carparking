<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings	;
use Maatwebsite\Excel\Concerns\WithMapping;

class InvoiceExport implements FromCollection, WithHeadings
{
    use Exportable ;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return  Invoice::select('number',
'invoice_date',
'due_date',
'status',
'reservation_value',
'amount_commission',
'discount',
'total')->get();


    }

    public function headings(): array
    {
        return [
            '#',
            'Invoice Date',
            'Due Date',
            'Status',
            'Reservation Value',
            'Amount Commission',
            'Discount',
            'Total',
        ];
    }
}
