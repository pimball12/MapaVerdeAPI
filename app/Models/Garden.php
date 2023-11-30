<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function main_picture(): BelongsTo {

        return $this->belongsTo(GardenImage::class, 'main_picture_id');
    }

    public function images(): HasMany   {

        return $this->hasMany(GardenImage::class, 'garden_id');
    }

    public function messages(): HasMany {

        return $this->hasMany(Message::class, 'garden_id');
    }

    public function contributors(): HasMany {

        return $this->hasMany(Contributor::class, 'garden_id');
    }
}
