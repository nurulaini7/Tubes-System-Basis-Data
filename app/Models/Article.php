<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'duration',
        'author_id',
        'tag_id',
        'status',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    public function tags()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(CommentArticle::class, 'article_id', 'id');
    }

    public function articleList()
    {
        return $this->belongsTo(ArticleList::class, 'article_id', 'id');
    }
}
