<?php
declare(strict_types=1);

namespace Pfort\Blog\Controllers;

use Pfort\Blog\App\Controller\BaseController;
use Pfort\Blog\App\Http\Request;

readonly class HomeController extends BaseController
{
    public function indexAction(): void {
        echo "Welcome to Home page!!";
    }

    public function aboutAction(Request $request, $id, $param2): void {
        echo sprintf("Incoming params: %s and %s\n", $id, $param2);
    }
}