<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $primaryKey = 'id';

    public function products() {
    	return $this->belongsToMany(Product::class);
    }

    public $timestamps = true;
}
