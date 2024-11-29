<?php
declare(strict_types=1);

use Pfort\Blog\Bootstrap;
use Pfort\Blog\Factories\ContainerFactory;

require __DIR__ . "/../vendor/autoload.php";

define("ROOT_DIR", realpath(__DIR__ . "/../"));

session_start();

$bootstrap = new Bootstrap(ContainerFactory::create());
$bootstrap->boot()->run();