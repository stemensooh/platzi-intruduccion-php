<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BlogPost;

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
        $blogPosts = new BlogPost([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'image' => 'images/example.jpg',
        ]);
        $result = $blogPosts->save();

        return $this->render('admin/insert-post.twig', ['result'=>$result]);
    }
}
