<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Giảm giá
    private $promo = 50;
    // Đuôi file hợp lệ
    private $legitExtension = array('jpg','png','gif','jpeg');

    protected function getPromo() {
    	return $this->promo;
    }

    protected function getLegitExtension() {
    	return $this->legitExtension;
    }
}
