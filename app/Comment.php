<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = 'comments';
	protected $primaryKey = 'id';

	public function posts() {
		return $this->belongsToMany(Post::class);
	}

	public function users() {
		return $this->belongsToMany(User::class);
	}
	public $timestamps = true;
}
