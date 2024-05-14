<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneTimePin extends Model
{
    use HasFactory;
    protected $table = 'otps';
    protected $guarded = [];
}
