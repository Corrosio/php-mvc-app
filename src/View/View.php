<?php
declare(strict_types=1);

namespace Pfort\Blog\View;

use Twig\Environment;

readonly final class View
{
    public function __construct(
        private Environment $twig
    ) {}

    public function render(string $template, array $context = []): string
    {
        return $this->twig->render($template, $context);
    }
}