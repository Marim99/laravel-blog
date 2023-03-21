<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes,Sluggable;


    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug',
    ];

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function comments(): MorphMany
    {
        return $this->MorphMany(Comment::class, 'commentable');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
