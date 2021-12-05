<?php

namespace App\Controllers;

use App\Models\BlogPost;

class IndexController extends BaseController {
    public function getIndex(){
        $blogPosts = BlogPost::query()->orderBy('id', 'desc')->get();
        return $this->render('index.twig', ['blogPosts'=>$blogPosts]);
    }

    public function getPost($postId){
        $messageError = '';
        $post = BlogPost::query()->find($postId);
        //print_r($post);

        if(!$post){
            $messageError = 'Post does not exist';
        }
        return $this->render('post.twig', ['post'=>$post, 'messageError' => $messageError]);
    }
}
