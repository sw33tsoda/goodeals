<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;

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

    ///////////////////////////////// KHÔNG DÙNG /////////////////////////////////////////
    // protected function saveImage($isImage,$file,$resourceName,$arrayWithExcludes,$dir) {
    //     $message = "Đã thêm.";
    //     $alert = "success";
    //     $arrayFinal = $arrayWithExcludes;
    //     if ($isImage) {
    //         $thisLegit = $this->legitExtension;
    //         if (in_array($file->getClientOriginalExtension(),$thisLegit) == 1) {
    //             $fileName = uniqid().'.'.$file->getClientOriginalExtension();
    //             $fileDir = storage_path().$dir;
    //             $moveFile = $file->move($fileDir,$fileName);
    //             $thisImage = array("$resourceName" => $fileName);
    //             $arrayFinal = array_merge($arrayWithExcludes,$thisImage);
    //         } else {
    //             $message = "Sai định dạng cho phép , nên không thể thêm ảnh";
    //             $alert = "warning";
    //         }
    //     }
    //     return array('arrayFinal' => $arrayFinal,'message' => $message, 'alert' => $alert);
    // }
    //////////////////////////////////////////////////////////////////////////////////////
}
