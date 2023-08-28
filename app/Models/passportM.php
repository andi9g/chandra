<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class passportM extends Model
{
    use HasFactory;
    protected $table = 'passport';
    protected $primaryKey = 'idpassport';
    protected $guarded=[];
}
