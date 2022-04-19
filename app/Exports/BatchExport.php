<?php

namespace App\Exports;

use App\Models\studentModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class BatchExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function collection()
    {
        return studentModel::where('batch_id',$this->id)->whereColumn('payAmount','>=','totalAmount')->orderBy('id','DESC')->get();
    }

    public function map($student): array
    {
        return [
            $student->id,
            $student->name,
            $student->mobile,
            $student->fathername,
            $student->mothername,
            $student->batch->batchno,
            $student->course->title,
            $student->totalAmount,
            $student->discount_amount,
            $student->payAmount,
            $student->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'Registration Number',
            'Student Name',
            'Mobile Number',
            'Father Name',
            'Mother Name',
            'Batch No',
            'Course',
            'Course Fee',
            'Discount',
            'Paid',
            'Date',
        ];
    }
}
