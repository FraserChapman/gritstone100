<?php

namespace App;

require_once 'vendor/autoload.php';

//error_reporting(E_ALL);

$f3 = \Base::instance();
$f3->config('config.ini');
$f3->run();