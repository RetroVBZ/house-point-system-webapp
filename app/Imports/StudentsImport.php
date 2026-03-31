<?php

namespace App\Imports;

use App\Models\students;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new students([
            'studentID' => $row['studentid'],
            'houseID' => $row['houseid'],
            'studentFirstName' => $row['studentfirstname'],
            'studentLastName' => $row['studentlastname'],
            'Grade' => $row['grade'],
            'section' => $row['section'],
        ]);
    }
}