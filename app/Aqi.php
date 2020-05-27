<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aqi extends Model
{
    public static function calculateAQIPM25($value) {
        if($value<=50) {
            $minimum=0;
        } else if($value<=51 && $value>100) {
            $minimum=51;
        } else if($value<=101 && $value>150) {
            $minimum=101;
        } else if($value<=151 && $value>300) {
            $minimum=151;
        } else if($value<=201 && $value>300) {
            $minimum=201;
        } else if($value<=301)  {
            $minimum=301;
        }
    }
}
