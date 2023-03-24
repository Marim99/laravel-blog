<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Tags\HasTags;

class Post extends Model
{
    use HasFactory,SoftDeletes,Sluggable,HasTags;

protected $morphClass='post';
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug',
        'image',
        'tags'
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
    protected static function boot()
    {

        parent::boot();
        static::deleting(function ($value) {
            if($value->image)
            {
                Storage::delete($value->image);
            }
            
        });
        static::updating(function ($value) {
                if ($value->image) {
                    $originalImagePath = $value->getOriginal('image');
                    $newImagePath = $value->getAttribute('image');
                    if ($originalImagePath != $newImagePath) {
                            if ($originalImagePath) {
                                Storage::delete($originalImagePath);
                            }
                    }
                }
        });
    }
    public function setImageAttribute($value)
    {
   
    $imageName = time().'.'.$value->getClientOriginalExtension();
    $value->storeAs('public/images/posts', $imageName);
    $this->attributes['image'] = 'storage/images/posts/'.$imageName;
    }
}
