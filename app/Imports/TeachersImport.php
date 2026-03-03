<?php

namespace App\Imports;

use App\Models\teachers;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class TeachersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new teachers([
            'teacherID' => $row['teacherid'],
            'teacherFirstName' => $row['teacherfirstname'],
            'teacherLastName' => $row['teacherlastname'],
            'houseID' => $row['houseid'],
        ]);
    }
}