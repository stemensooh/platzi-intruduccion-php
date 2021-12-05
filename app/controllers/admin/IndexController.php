<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;

class IndexController extends BaseController {
    public function getIndex(){

        if(isset($_SESSION['userId'])){
            //print_r($_SESSION['userId']);
            $userId = $_SESSION['userId'];
            $user = User::query()->find($userId);
            if($user){
                return $this->render('admin/index.twig', ['user' => $user ]);
            }
        }
        header('Location:' . BASE_URL. 'auth/login');
    }
}

