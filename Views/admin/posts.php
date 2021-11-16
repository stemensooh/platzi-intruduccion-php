
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Blog Title</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <h2>Posts</h2>

            <a class="btn btn-primary" href="<?php echo BASE_URL; ?>admin/posts/create">New Post</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($blogPosts as $blog){
                    echo '<tr>';
                    echo '<td>'.$blog['title'].'</td>';
                    echo '<td>Edit</td>';
                    echo '<td>Delete</td>';
                    echo '</tr>';
                }

                ?>
                </tbody>

            </table>


        </div>
        <div class="col-md-4">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto atque consectetur, consequuntur culpa, dolore error est eum facilis fugiat, in iusto maiores nulla placeat quo rem sed sunt ullam!

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <footer>
                This is a footer
                <a href="<?php echo BASE_URL; ?>admin">Admin Panel</a>            </footer>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>