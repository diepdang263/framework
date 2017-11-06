<?php

namespace App\Controller;

class ErrorController
{
    public function err500($message = '')
    {
        echo $message;
        echo 'Co loi xay ra vui long thu lai sau!';
    }
}
