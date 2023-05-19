<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'image',
        'about',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function commentArticle()
    {
        return $this->hasMany(CommentArticle::class, 'user_id', 'id');
    }

    public function commentList()
    {
        return $this->hasMany(CommentList::class, 'user_id', 'id');
    }

    public function list()
    {
        return $this->hasMany(ArticleList::class, 'user_id');
    }

    public function listOwner()
    {
        return $this->hasMany(ArticleList::class, 'owner_id');
    }

    public function followers()
{
    return $this->belongsToMany(User::class, 'mutuals', 'user_id', 'follower_id');
}

public function following()
{
    return $this->belongsToMany(User::class, 'mutuals', 'follower_id', 'user_id');
}

public function isFollowing(User $user)
{
    return $this->following()->where('user_id', $user->id)->exists();
}


}


