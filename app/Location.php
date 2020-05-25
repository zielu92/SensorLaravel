<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name', 'floor', 'details', 'place_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place() {
        return $this->belongsTo('App\Place');
    }

    public function device() {
        return $this->hasMany('App\Device');
    }

    public function sensor() {
        return $this->hasManyThrough('App\Sensor', 'App\Device');
    }

    public function value24($name) {
       return $this->sensor()->where('valueName', 'like', $name)
            ->where('sensors.created_at', '>',Carbon::parse('-24 hours'));
    }

    public function checkValue24($name) {
        $count = $this->value24($name)->count();
        return $count > 0;
    }

    public function avgValue24($name) {
        $avg = $this->value24($name)->avg('value');
        return round($avg,2);
    }

    public function minValue24($name) {
        $avg = $this->value24($name)->min('value');
        return round($avg,2);
    }

    public function maxValue24($name) {
        $avg = $this->value24($name)->max('value');
        return round($avg,2);
    }
}
