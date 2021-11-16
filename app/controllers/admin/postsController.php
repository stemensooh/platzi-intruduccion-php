<?php

namespace App\Controllers\Admin;

class PostsController {
    public function getIndex(){
        global $pdo;
        $query = $pdo->prepare("SELECT * FROM blog_posts ORDER BY id DESC");
        $query->execute();
        $blogPosts = $query->fetchAll(\PDO::FETCH_ASSOC);
        return render('../Views/admin/posts.php', ['blogPosts'=>$blogPosts]);
    }

    public function getCreate(){
        $result = false;
        return render('../Views/admin/insert-post.php', ['result'=>$result]);
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

        return render('../Views/admin/insert-post.php', ['result'=>$result]);
    }
}
