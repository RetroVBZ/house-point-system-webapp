<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'studentID';
    protected $fillable = [
        'studentID',
        'houseID',
        'studentFirstName',
        'studentLastName',
        'Grade',
        'section',
    ];
}
