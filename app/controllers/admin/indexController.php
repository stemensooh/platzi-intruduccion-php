<?php

namespace App\Controllers\Admin;

class IndexController {
    public function getIndex(){
        return render('../Views/admin/index.php');
    }
}

