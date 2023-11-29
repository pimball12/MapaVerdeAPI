<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GardenImage extends Model
{
    use HasFactory;

    protected $fillable =  [

        'file',
        'garden_id'
    ];

    public function garden(): BelongsTo {

        return $this->belongsTo(Garden::class, 'garden_id');
    }
}
