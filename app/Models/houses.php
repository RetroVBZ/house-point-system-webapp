<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class houses extends Model
{
    protected $table = 'Houses';
    protected $primaryKey = 'houseID';
    protected $fillable = [
        'houseID',
        'houseName',
        'points',
    ];
}
