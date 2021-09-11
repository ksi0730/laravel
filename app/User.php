<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','twitter', 'nickname', 'politician',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // Teamsテーブルとのリレーション （主テーブル側）
    public function o_teams() {
       return $this->hasMany('App\Team');
    }
     // Teamsテーブルとの多対多リレーション
     public function my_teams() {
        return $this->belongsToMany('App\Team');
    }
    // Enquetesテーブルとのリレーション （主テーブル側）
    public function o_enquetes() {
       return $this->hasMany('App\Enquete');
   }
    // Enquetesテーブルとの多対多リレーション
     public function my_enquetes() {
        return $this->belongsToMany('App\Enquete');
    }
    // Commentsテーブルとのリレーション （主テーブル側）
    public function o_comments() {
       return $this->hasMany('App\Comment');
   }
    // Commentsテーブルとの多対多リレーション
     public function my_comments() {
        return $this->belongsToMany('App\Comment');
    }
    // Questionsテーブルとのリレーション （主テーブル側）
    public function o_questions() {
       return $this->hasMany('App\Question');
   }
    // Questionsテーブルとの多対多リレーション
     public function my_questions() {
        return $this->belongsToMany('App\Question');
    }
}
