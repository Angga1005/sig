<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function point_of_interest()
    {
        return $this->hasMany(PointOfInterest::class);
    }
}
