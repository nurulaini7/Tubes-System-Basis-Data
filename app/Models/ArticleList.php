<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'visibilty',
        'user_id',
        'article_id',
        'owner_id',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'article_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(CommentList::class, 'article_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
