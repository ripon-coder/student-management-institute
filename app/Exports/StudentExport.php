<?php

namespace App\Exports;

use App\Models\studentModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Date;
use Carbon\Carbon;


class StudentExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return studentModel::orderBy('id','DESC')->get();
    }

    public function map($student): array
    {
        return [
            $student->id,
            $student->name,
            $student->mobile,
            $student->fathername,
            $student->mothername,
            $student->course->title,
            $student->note,
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
            'Course',
            'Note',
        ];
    }
}
