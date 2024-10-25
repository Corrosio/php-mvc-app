<?php
declare(strict_types=1);

use Pfort\Blog\Bootstrap;
use Pfort\Blog\Factories\DiContainerFactory;

require __DIR__ . "/../vendor/autoload.php";

define("ROOT_DIR", realpath(__DIR__ . "/../"));

session_start();

$bootstrap = new Bootstrap(DiContainerFactory::create());
$bootstrap->boot()->run();