<?php

namespace App\Exports;

use App\Results;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ResultsExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    protected $id;

    function __construct($id, $stream) {
        $this->id = $id;
        $this->stream = $stream;
    }

    public function headings():array
    {
        return [
            "Fname",
            "Sname",
            "Comp",
            "Grm",
            "Eng",
            "Insha",
            "Lugha",
            "Kisw",
            "Math",
            "Scs",
            "SS",
            "RE",
            "SS/RE",
            "Total"
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Results::getResults($this->id, $this->stream));
    }
}
