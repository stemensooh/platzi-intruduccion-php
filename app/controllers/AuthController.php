<?php

namespace App\Controllers;

use App\Models\BlogPost;
use App\Models\User;
use Sirius\Validation\Validator;
use function Sirius\Validation\Helper;

class AuthController extends BaseController {
    public function getLogin(){
        return $this->render('login.twig');
    }

    public  function  postLogin(){
        $errors = [];

        $validator = new Validator();
        $validator->add('email', 'required', null, 'El email es requerido');
        $validator->add('password', 'required', null, 'El password es requerido');

        if ($validator->validate($_POST)) {
            $user = User::query()->where('email', $_POST['email'])->first();
            if ($user) {
                /*
                echo $_POST['password'];
                echo "<br>";
                echo $user-> password;
                */
                if (password_verify($_POST['password'], $user->password)) {
                    $_SESSION['userId'] = $user->id;
                    header('Location:' . BASE_URL. 'admin');
                    return null;

                }else{
                    echo "<br>";
                    echo 'no coindice';
                }
            }
            //print_r(password_verify($_POST['password'], $user->password));
            $validator->addMessage('email', 'Username and/or password does not match');
        }

        $errors = $validator->getMessages();
        return $this->render('login.twig', ['errors' =>$errors]);
    }

    public function getLogout(){
        unset($_SESSION['userId']);
        header('Location:' . BASE_URL . 'auth/login');
    }
}
