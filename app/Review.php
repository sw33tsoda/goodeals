<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
   	protected $table = "reviews";
   	protected $primaryKey = "id";

   	public function products() {
   		return $this->belongsToMany(Product::class);
   	}

   	public $timestamps = true;
}
