<?php

namespace App\Exports;

use App\Results;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ResultsExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function headings():array
    {
        return [
            "UPI NO.",
            "Composition",
            "Grammar",
            "English",
            "Insha",
            "Lugha",
            "Kiswahili",
            "Mathematics",
            "Science",
            "Social Studies",
            "Religious Education",
            "SS/RE"
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Results::getResults($this->id));
        //return AppResults::all();
    }
}
