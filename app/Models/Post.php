<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
        'category_id',
        'photo_id',
        'title',
        'body',
        'slug'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function photo() {

        return $this->belongsTo('App\Models\Photo');
    }
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    public function sluggable(): array
    {
        // TODO: Implement sluggable() method.
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function postViews() {

        $this->views++;
        return $this->save();

    }

    public function placeHolder() {

        return 'https://picsum.photos/1280/720';
    }
}
