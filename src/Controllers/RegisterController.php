<?php
declare(strict_types=1);

namespace Pfort\Blog\Controllers;

use Pfort\Blog\App\Controller\BaseController;

final class RegisterController extends BaseController
{
    public function indexAction(): void
    {
        $this->render('sign-up.twig', [
            'title' => 'Přihlásit se',
            'subTitle' => 'Pro přihlášení vyplňte přihlašovací údaje'
        ]);
    }

    public function registerAction(): void
    {
        $this->render('register.twig', [
            'title' => 'Registrujte se',
            'subTitle' => 'Pro vytvoření účtu je potřeba se registrovat!!!'
        ]);
    }
}