<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    public static function tagColor($value, $type) {
        $result = "blue";
        switch(strtoupper($type)) {
            case 'PM2.5':
            case 'PM1':
                if ($value <= 60) {
                    $result = "green";
                } else if ($value > 60 && $value <= 120) {
                    $result = "yellow";
                } else if ($value > 120 && $value <= 250) {
                    $result = "red";
                } else {
                    $result = "black";
                }
                break;
            case 'PM10':
                if ($value <= 100) {
                    $result = "green";
                } else if ($value > 100 && $value <= 350) {
                    $result = "yellow";
                } else if ($value > 350 && $value <= 430) {
                    $result = "red";
                } else {
                    $result = "black";
                }
                break;
            case 'TEMPERATURE':
                //Temperature for Thailand
                if ($value < 5) {
                    $result = "blue";
                } else if ($value > 5 && $value <= 20) {
                    $result = "green";
                } else if ($value > 20 && $value <= 30) {
                    $result = "yellow";
                } else if ($value > 30 && $value <= 45) {
                    $result = "red";
                } else {
                    $result = "black";
                }
                break;
        }
        return $result;
    }
}
