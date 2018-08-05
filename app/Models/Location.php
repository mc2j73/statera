<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = [
    	'width',
        'height',
        'texture_name'
    ];

    public function charcters()
    {
    	return $this->hasMany('App\Models\Character', 'id', 'location_id');
    }
}
