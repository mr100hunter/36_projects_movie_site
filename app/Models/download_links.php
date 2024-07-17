<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class download_links extends Model
{
    use HasFactory;

    protected $table = "download_links";
    protected $primaryKey = "id";
}
