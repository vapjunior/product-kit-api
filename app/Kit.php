<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    protected $fillable = [
        'id',
        'name', 
        'description', 
        'ml_categorie_id',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
