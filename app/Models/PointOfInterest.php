<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointOfInterest extends Model
{
    protected $table = 'point_of_interest';
    protected $fillable = [
        'name',
        'address',
        'phone',
        'longitude',
        'latitude',
        'category_id',
        'created_by'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
