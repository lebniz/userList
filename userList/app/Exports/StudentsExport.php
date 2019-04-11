<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings
{
	
	use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
	public function sheets(): array
    {
        return [
            // Select by sheet index
            0 => new StudentsExport(),
            1 => new StudentsExport(),
        ];
    }

	// /**
 //    * @var Invoice $invoice
 //    */
 //    public function map($invoice): array
 //    {
 //        return [
 //        ];
 //    }

    public function headings(): array
    {
        return [
           ['name', 'age', 'gender'],
           ['姓名', '年齡', '性別'],
        ];
    }

        public function collection()
    {
        // return Student::all()->where('name','Chole');
        // return Student::get('name');
        return collect(Student::select('name','age','gender')->get());
        // return Student::select('name','age','gender')->get();
    }

    public function actions(Request $request)
	{
	    return [
	        (new DownloadExcel)->withFilename('users-' . time() . '.xlsx'),
	        (new DownloadExcel)->withHeadings(),

	    ];
	}

}
