<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    public function reviews()
    {
    	return $this->hasMany(Review::class);
    }

    public function categories()
    {
    	return $this->belongsTo('App\ProductCategory','platform_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function transaction_logs() {
        return $this->hasMany(TransactionLog::class);
    }

    public $timestamps = true;
}
