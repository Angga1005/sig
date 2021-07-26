<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointOfInterest extends Model
{
    protected $table = 'point_of_interest';
    protected $fillable = [
        'name',
        'address',
        'longitude',
        'latitude',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
