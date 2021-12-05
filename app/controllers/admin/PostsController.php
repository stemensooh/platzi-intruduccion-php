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

    public function postCreate() {

        $errors = [];
        $result = false;
        $validator = new Validator();
        $validator->add('title', 'required');
        $validator->add('content', 'required');

        if ($validator->validate($_POST)) {
            $blogPosts = new BlogPost([
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => 'images/example.jpg',
            ]);

            if ($_POST['image']){
                $blogPosts->image = $_POST['image'];
            }

            $result = $blogPosts->save();
        } else {
           $errors = $validator->getMessages();
           //print_r($errors);
        }

        return $this->render('admin/insert-post.twig', [
            'result'=>$result,
            'errors'=>$errors
        ]);
    }

    public function getUpdate($postId){
        $post = BlogPost::query()->find($postId);
        return $this->render('admin/update-post.twig', ['post'=>$post] );
    }

    public function postUpdate(){

        $errors = [];
        $result = false;
        $validator = new Validator();
        $validator->add('id', 'required');
        $validator->add('title', 'required');
        $validator->add('content', 'required');
        $post = null;

        if ($validator->validate($_POST)) {

            $post = BlogPost::query()->find($_POST['id']);
            if($post){
                echo $post;
                $post->title = $_POST['title'];
                $post->content = $_POST['content'];
                $post->image = $_POST['image'];
            }
            if ($_POST['image']){
                $post->image = $_POST['image'];
            }

            $result = $post->save();
        } else {
            $errors = $validator->getMessages();
        }

        return $this->render('admin/update-post.twig', [
            'result'=>$result,
            'errors'=>$errors
        ]);
    }

    public function getDelete($postId){
        $post = BlogPost::query()->find($postId);
        $post->delete();

        header('Location:' . BASE_URL. 'admin/posts');
        return null;
    }
}
