<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class snaptokenM extends Model
{
    use HasFactory;
    protected $table = 'snaptoken';
    protected $primaryKey = 'idsnaptoken';
    protected $guarded=[];
}
