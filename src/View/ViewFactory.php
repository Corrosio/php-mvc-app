<?php
declare(strict_types=1);

namespace Pfort\Blog\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final class ViewFactory
{
    public static function create(): View
    {
        $viewDir = ROOT_DIR . "/src/View/Templates";
        $loader = new FilesystemLoader($viewDir);
        return new View(new Environment($loader, []));
    }
}