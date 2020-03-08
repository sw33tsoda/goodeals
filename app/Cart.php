<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';

    public $timestamps = true;

    public function products() {
    	return $this->belongsTo('App\Product','product_id');
    }

    public function users() {
    	return $this->belongsTo('App\User','user_id');
    }
}
