<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
   	protected $table = 'transaction_log';
   	protected $primaryKey = 'id';

   	public function products() {
   		return $this->belongsTo(Product::class,'product_id');
   	}

   	public function users() {
   		return $this->belongsTo(User::class,'user_id');
   	}

   	public $timestamps = true;
}
