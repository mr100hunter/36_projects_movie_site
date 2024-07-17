<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class live_tv extends Model
{
    use HasFactory;
    protected $table = "live_tvs";
    protected $primaryKey = "id";
}
