<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BlogPost;
use Sirius\Validation\Validator;

class PostsController extends BaseController{
    public function getIndex(){
        $blogPosts = BlogPost::all();
        return $this->render('admin/posts.twig', ['blogPosts'=>$blogPosts]);
    }

    public function getCreate(){
        $result = false;
        return $this->render('admin/insert-post.twig', ['result'=>$result]);
    }

    public function postCreate(){
        $errors = [];
        $result = false;
        $validator = new Validator();
        $validator->add('title', 'required');
        $validator->add('content', 'required');

        if($validator->validate($_POST)){
            $blogPosts = new BlogPost([
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => 'images/example.jpg',
            ]);
            $result = $blogPosts->save();
        } else {
           $errors = $validator->getMessages();
           print_r($errors);
        }

        return $this->render('admin/insert-post.twig', [
            'result'=>$result,
            'errors'=>$errors
        ]);
    }
}
