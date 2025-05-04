<?php

use App\Http\Controllers\UserController;

require_once __DIR__ . "/../../vendor/autoload.php";

$user = new UserController();

$user->logout();
