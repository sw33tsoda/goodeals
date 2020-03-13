<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
   	protected $table = "reviews";
   	protected $primaryKey = "id";

   	public function products() {
   		return $this->belongsTo(Product::class,'product_id');
   	}

   	public function users() {
   		return $this->belongsTo(User::class,'user_id');
   	}

   	public $timestamps = true;
}
