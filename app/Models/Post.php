<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'excerpt', 'body'];

    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters)
    {
        if(isset($filters['search'])){
            $query->where(function ($query) use ($filters) {
                $query->where('title', 'like', '%'.$filters['search'].'%')
                      ->orWhere('body', 'like', '%'.$filters['search'].'%');
            });
        }

        if(isset($filters['category'])){
            $query->whereHas('category', function ($query) use ($filters) {
                $query->where('slug', $filters['category']);
            });
        }

        if(isset($filters['author'])){
            $query->whereHas('author', function ($query) use ($filters) {
                $query->where('username', $filters['author']);
            });
        }
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
