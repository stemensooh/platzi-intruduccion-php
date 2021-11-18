<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BlogPost;
use App\Models\User;
use Sirius\Validation\Validator;

class UserController extends BaseController {
    public function getIndex(){
        $users = User::all();
        return $this->render('admin/users.twig', [
            'users' => $users
        ]);
    }

    public function getCreate(){
        $result = false;
        return $this->render('admin/insert-user.twig', ['result'=>$result]);
    }

    public function postCreate() {
        $errors = [];
        $result = false;
        $validator = new Validator();
        $validator->add('name', 'required', null, 'El usuario es requerido');
        $validator->add('email', 'required');
        $validator->add('password', 'required');

        if ($validator->validate($_POST)) {
            $user = new User([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            ]);
            $result = $user->save();
        } else {
            $errors = $validator->getMessages();
            //print_r($errors);
        }

        return $this->render('admin/insert-user.twig', [
            'result'=>$result,
            'errors'=>$errors
        ]);
    }
}