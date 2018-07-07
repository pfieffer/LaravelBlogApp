<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table name
    protected $table = 'posts';
    //primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getImageUrl($value)
    {
      if ($value) {
          return asset('storage/cover_images/' . $value);
      } else {
          return asset('storage/cover_images/noimage.jpg');
      }
    }
}
