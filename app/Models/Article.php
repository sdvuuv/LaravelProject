<?php

    
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'content', 'is_published', 'published_at', 'category_id'];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime', // Важно для работы с датами
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function scopePublished(Builder $query)
    {
        return $query->where('is_published', true);
    }
}

  