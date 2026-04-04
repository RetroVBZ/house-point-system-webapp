<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HousePoints extends Model
{
    protected $table = 'Points'; // match table name
    protected $fillable = ['houseID', 'teacherID', 'Points', 'Time'];
    public $timestamps = true;
}