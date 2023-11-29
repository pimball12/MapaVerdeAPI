<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Garden extends Model
{
    use HasFactory;

    protected $fillable = [

        'lat',
        'lng',
        'name',
        'description',
        'contact_phone',
        'contact_email',
        'opening_time',
        'closing_time',
        'running'
    ];

    protected $hidden = [

        'owner_id',
        'main_picture_id'
    ];

    public function owner(): BelongsTo  {

        return $this->belongsTo(User::class, 'owner_id');
    }

    public function main_picture(): HasOne {

        return $this->hasOne(GardenImage::class, 'id');
    }
}
