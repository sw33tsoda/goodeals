<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = 'comments';
	protected $primaryKey = 'id';

	public function posts() {
		return $this->belongsTo(Post::class,'post_id');
	}

	public function users() {
		return $this->belongsTo(User::class,'user_id');
	}
	
	public $timestamps = true;
}
