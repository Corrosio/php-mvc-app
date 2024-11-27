<?php
declare(strict_types=1);

namespace Pfort\Blog\Controllers;

use Pfort\Blog\App\Controller\BaseController;
use Pfort\Blog\App\Http\Request;

final class HomeController extends BaseController
{
    public function indexAction(): void {
        $this->render('index.twig', [
            'title' => 'Blog',
            'subTitle' => 'Vítejte na mém blogu!!',
        ]);
    }

    public function aboutAction(Request $request, $id, $param2): void {
        echo sprintf("Incoming params: %s and %s\n", $id, $param2);
    }

    public function testAction(): void
    {
        var_dump($this->request);
    }
}