<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PostsController extends BaseController{
    public function getIndex(){
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM blog_posts ORDER BY id DESC");
        $query->execute();
        $blogPosts = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $this->render('admin/posts.twig', ['blogPosts'=>$blogPosts]);
    }

    public function getCreate(){
        $result = false;
        return $this->render('admin/insert-post.twig', ['result'=>$result]);
    }

    public function postCreate(){
        global $pdo;
        $sql = 'INSERT INTO blog_posts(title, content, date, image) VALUES(:title, :content, :date, :image)';
        $query = $pdo->prepare($sql);
        $result = $query->execute([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'date' => date("Y/m/d h:i:sa"),
            'image' => 'images/example.jpg' ,
        ]);

        return $this->render('admin/insert-post.twig', ['result'=>$result]);
    }
}
