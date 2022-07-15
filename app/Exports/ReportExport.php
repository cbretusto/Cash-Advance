<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
Use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheet\PackingAndShipmentSheet;
use App\Exports\Sheet\PartsLotSheet;
use App\Exports\Sheet\RuncardDetails;

class ReportExport implements ShouldAutoSize, WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }

    use Exportable;

    protected $records;
    protected $type;
    protected $device_name;
    protected $start_date;
    protected $end_date;

    function __construct($type, $records, $device_name, $start_date, $end_date)
    {
        $this->records = $records;
        $this->type = $type;
        $this->device_name = $device_name;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    //for multiple sheets
    public function sheets(): array
    {
        $sheets = [];

        if($this->type == 1){
        	$sheets[] = new PackingAndShipmentSheet($this->records, $this->device_name);
        }
        else if($this->type == 2){
            $sheets[] = new PartsLotSheet($this->records, $this->device_name, $this->start_date, $this->end_date);

            for($index = 0; $index < count($this->records); $index++){
                $sheets[] = new RuncardDetails($this->records[$index], $this->records[$index]->runcard_no);
            }
        }

        return $sheets;
    }
}
