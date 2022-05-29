<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['file','alt'];

    // Making Dynamic Images Directory Link;
    protected $images = '/images/';

    // Crating Accessors for Images Link;
    protected function getFileAttribute($photo){
        return $this->images . $photo;
    }

    public function ext($photo) {
        $type = substr($photo, strpos($photo, ".") + 1);
        return $type;
    }
}
