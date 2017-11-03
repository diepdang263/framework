<?php

namespace App\Controller;

class DefaultController {
    public function Index($test) {
        var_dump($test);
    }

    public function Pages() {
        echo 'Sub pages';
    }
}
