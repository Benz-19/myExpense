<?php

namespace App\Services;

include_once __DIR__ . '/../Helpers/all_inlcudes.php';

class messageService
{

    public static function errorMesssage($msg)
    {
        return '<div class="error">' . ' <h1> Error: ' . $msg . '</h1>' . '</div>';
    }

    public static function successMessage($msg)
    {
        return '<div class="success">' . ' <h1>' . $msg . '</h1>' . '</div>';
    }

}

