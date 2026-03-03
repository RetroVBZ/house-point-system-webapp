<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class points extends Model
{
    protected $table = 'Houses';
    protected $primaryKey = 'houseID';
    protected $fillable = [
        'houseID',
        'houseName',
        'points',
    ];
}
