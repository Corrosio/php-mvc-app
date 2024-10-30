<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Controller;


use Pfort\Blog\App\Http\Request;

readonly final class ControllerProxy implements ControllerInterface
{
    public function __construct(private ControllerInterface $controller) {}

    public function execute(Request $request, string $method, array $params = []): void
    {
        $this->controller->execute($request, $method, $params);
    }
}