<?php
namespace App\Helper;

use Illuminate\Http\Exceptions\HttpResponseException;

class CommonHelper{

    public static function sendError($message,$errors=[], $code=401){
        $response = ['success' => false , 'message' =>$message , 'status' => $code];
        if(!empty($errors)){
            $response['data'] = $errors;
        }
        throw new HttpResponseException(response()->json($response,$code));
    }


}



?>