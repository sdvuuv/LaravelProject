<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'is_approved', 'commentable_id', 'commentable_type'];

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}