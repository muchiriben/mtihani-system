<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentsExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function headings():array
    {
        return [
            "UPI NO.",
            "First Name",
            "Second Name",
            "Parent Names",
            "Parent Contact"
        ];
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Student::getStudents($this->id));
       // return Student::all();
    }
}
