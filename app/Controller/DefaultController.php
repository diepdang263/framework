<?php

namespace App\Controller;

use App\Core\Log;

class DefaultController extends AppController {
    public function Index($test) {
        echo $test1;
    }

    public function Pages() {
        echo 'Sub pages';
    }
}
