<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Partner;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "room_id",
        "start_date",
        "end_date", 
        "status",
        "partner_id",
        "marriage_contract"
    ];

   public function room() : BelongsTo
   {
        return $this->belongsTo(Room::class);
   }

   public function user() : BelongsTo
   {
     return $this->belongsTo(User::class);
   }


    
}
