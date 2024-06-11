<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Room;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "is_initial",
        "room_id"
    ];

    public function images() : BelongsTo
    {
        return $this->belongsTo(Room::class);
    }


}
