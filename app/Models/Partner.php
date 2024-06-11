<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        "first_name",
        "last_name",
        "cin",
        "user_id",
        "marriage_contact",
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
