<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Observers\RegisterObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pivot',
        'hash',
        'hash_expire',
        'updated_at',
        'created_at',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        User::class => [RegisterObserver::class]
    ];

    /**
     * Password attribute.
     *
     * @param $password
     *
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Users written posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Users followers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follower_users', 'follower_id', 'user_id');
    }

    /**
     * Users followings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follower_users', 'user_id', 'follower_id')->withTimestamps();
    }

}
