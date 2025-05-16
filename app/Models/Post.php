<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'slug',
        'status',
        'category_id',
        'extract',
        'body',
    ];

    //relacion de uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //relacion de uno a muchos inversa
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //relacion de muchos a muchos
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    //relacion de uno a uno polimorfica
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
