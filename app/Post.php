<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function comments() {
    	return $this->hasMany(Comment::class);
    }

    public function categories() {
        return $this->hasMany(PostCategory::class);
    }
}
