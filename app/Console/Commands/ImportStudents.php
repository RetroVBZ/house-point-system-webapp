<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;

class ImportStudents extends Command
{
    protected $signature = 'app:import-students {file}';
    protected $description = 'Import students from Excel file';

    public function handle()
    {
        $file = $this->argument('file'); // <-- this gets the Excel file path

        Excel::import(new StudentsImport, $file);

        $this->info('Students imported successfully!');
    }
}