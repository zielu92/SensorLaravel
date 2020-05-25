<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = ['name', 'details', 'lat', 'lon', 'icon_id', 'picture_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function location() {
        return $this->hasMany('App\Location');
    }

    public function picture() {
        return $this->belongsTo('App\Photo');
    }

    public function icon() {
        return $this->belongsTo('App\Photo');
    }

    public function getPlaces() {
        return $this->all();
    }


}
