<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderM extends Model
{
    use HasFactory;
    protected $table = 'pakettravel';
    protected $primaryKey = 'idpakettravel';
}
