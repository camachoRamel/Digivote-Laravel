<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $guarded = [];

    protected $primaryKey = 'stud_id';

    public function user() : HasOne{
        return $this->hasOne(User::class);
    }
}
