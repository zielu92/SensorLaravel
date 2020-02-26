<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'name', 'location', 'mac'
    ];

    public function id($mac) {
        $device = $this->where('mac','=', $mac)->firstOrFail();
        return $device->id;
    }
}
