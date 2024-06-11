<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [ 
        "type",
        "is_available",
        "price",
        "conforts"
    ];

    public function images() : HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function capacity()
    {   
        $type = strtolower($this->type);

        switch ($type) {
            case 'single':
              return 1;
                break;

            case 'double':
                return 2;
                break;

            case 'triple':
                return 3;
                break;
        }
    }
}


