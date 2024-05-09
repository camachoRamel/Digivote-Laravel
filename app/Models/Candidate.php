<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Candidate extends Model
{
    use HasFactory;
    protected $table = 'candidates';

    protected $guarded = [];

    protected $primaryKey = 'candidate_id';

    public function parties() : BelongsTo{
        return $this->belongsTo(Party::class);
    }

    public function user() : BelongsTo{
        return $this->belongsTo(User::class);
    }
}
