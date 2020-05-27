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

    //https://www.cs.sonoma.edu/cs115/F17/proj/p1/cs115_p1.html#calc
    public function calculateAQIPM25($value) {
        $substraction24 = ($this->maxValue24('PM2.5')-$this->minValue24('PM2.5'))==0? 1: ($this->maxValue24('PM2.5')-$this->minValue24('PM2.5'));
        if($value<=50) {
            $minimum=0;
            $result = 51/$substraction24*($value-$this->minValue24('PM2.5'))+$minimum;
        } else if($value<=51 && $value>100) {
            $minimum=51;
            $result = 49/$substraction24*($value-$this->minValue24('PM2.5'))+$minimum;
        } else if($value<=101 && $value>150) {
            $minimum=101;
            $result = 49/$substraction24*($value-$this->minValue24('PM2.5'))+$minimum;
        } else if($value<=151 && $value>300) {
            $minimum=151;
            $result = 149/$substraction24*($value-$this->minValue24('PM2.5'))+$minimum;
        } else if($value<=201 && $value>300) {
            $minimum=201;
            $result = 99/$substraction24*($value-$this->minValue24('PM2.5'))+$minimum;
        } else if($value<=301)  {
            $minimum=301;
            $result = 199/$substraction24*($value-$this->minValue24('PM2.5'))+$minimum;
        } else {
            return null;
        }
        if(round($result)<0) $result=round($result)*-1;
        return round($result);
    }

    public function lastUpdatedDevice() {
        return $this->sensor()->orderBy('id', 'DESC')->limit(1)->get()[0]['device_id'];
    }


}
