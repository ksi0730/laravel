<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
     // Userテーブルとのリレーション （従テーブル側）
     public function user() {
        return $this->belongsTo('App\User');
    }
     // Userテーブルとの多対多リレーション
     public function members() {
        return $this->belongsToMany('App\User');
    }
    public function comments(){
		// チームはたくさんのコメントを持つ
		return $this->hasMany('Comment', 'team_id');
	}
}
