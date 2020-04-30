<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $upload = '/images/';
    protected $fillable = ['path', 'originalName'];

    public function place() {
        return $this->belongsToMany('App\Place');
    }

    public function getPathAttribute($photo) {
        return $this->upload . $photo;
    }

    public function getOriginalNameAttribute($photo) {
        return pathinfo($photo, PATHINFO_FILENAME);
    }

    /**
     * Uploading photo to server and update in DB
     * @param $file
     * @param $newName
     * @return $photo_id
     */
    public function photoUpload($file, $newName){

        $name = uniqid($newName) . '.' . $file->getClientOriginalExtension();
        $file->move('images', $name);

        $photo = Photo::create(['path'=>$name, 'originalName'=>$file->getClientOriginalName()]);

        return $photo->id;
    }
}
