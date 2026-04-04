<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teachers extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'teacherID';
    protected $fillable = [
        'teacherName',
        'subject',
        'houseID',
        'password'
    ];
}
