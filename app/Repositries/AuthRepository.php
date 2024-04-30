<?php
namespace App\Repositries;

use App\Helper\CommonHelper;
use Illuminate\Support\Facades\Auth;

class AuthRepository{

    //user credential check here .
    public function auth_login($credential){

        if(!Auth::attempt($credential)){
           CommonHelper::sendError('email or password is wrong !!!');
        }

        return true;

    }

}


?>