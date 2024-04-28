<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voter extends Model
{
    use HasFactory;

    protected $table = 'voters';

    protected $guarded = [];


    public function user() : BelongsTo{
        return $this->belongsTo(User::class);
    }
}
