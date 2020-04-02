<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = ['name', 'details', 'lat', 'lon'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function location() {
        return $this->hasMany('App\Location');
    }
}