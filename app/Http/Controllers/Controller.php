<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use App\TransactionLog;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Giảm giá
    private $discount = 5;
    // Đuôi file hợp lệ
    private $legitExtension = array('jpg','png','gif','jpeg');

    protected function getDiscount() {
    	return $this->discount;
    }

    protected function discountThis($basedPrice) {
        return $basedPrice * ((100 - $this->getDiscount()) / 100);
    }

    protected function getLegitExtension() {
    	return $this->legitExtension;
    }

    protected function transaction_log($info,$transaction_type) {
        $data = array();
        function inputData($user_id,$product_id,$transaction_value,$transaction_type) {
            return [
                'user_id' => $user_id,
                'product_id' => $product_id,
                'transaction_value' => $transaction_value,
                'transaction_type' => $transaction_type,
                'created_at' => Carbon::now()
            ];
        }
        if ($info->count() > 1) {
            foreach ($info as $i) {
                array_push($data,inputData($i->user_id,$i->product_id,$this->discountThis($i->products->price),$transaction_type));
            }
        } else {
            $info = $info->first();
            array_push($data,inputData($info->user_id,$info->product_id,$this->discountThis($info->products->price),$transaction_type));
        }
        return TransactionLog::insert($data);
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
