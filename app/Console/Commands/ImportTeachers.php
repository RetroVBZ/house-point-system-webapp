<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TeachersImport;

class ImportTeachers extends Command
{
    protected $signature = 'app:import-teachers {file}';
    protected $description = 'Import teachers from Excel file';

    public function handle()
    {
        $file = $this->argument('file'); // <-- this gets the Excel file path

        Excel::import(new TeachersImport, $file);

        $this->info('Teachers imported successfully!');
    }
}
