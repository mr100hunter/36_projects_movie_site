<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loging_log extends Model
{
    use HasFactory;

    protected $table = "loging_logs";
    protected $primaryKey = "id";
}
