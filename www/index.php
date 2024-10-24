<?php
declare(strict_types=1);

use Pfort\Blog\Bootstrap;

require __DIR__ . "/../vendor/autoload.php";

define("ROOT_DIR", realpath(__DIR__ . "/../"));

$app = Bootstrap::boot();
$app->run();