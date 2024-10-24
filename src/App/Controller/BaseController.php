<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Controller;

use Pfort\Blog\App\Controller\ControllerInterface;
use Pfort\Blog\App\Exceptions\ControllerException;
use Pfort\Blog\App\Http\Request;

readonly abstract class BaseController implements ControllerInterface
{

    /**
     * @throws ControllerException
     */
    public function execute(Request $request, string $method, array $params = []): void
    {
        if (! method_exists($this, $method)) {
            throw new ControllerException('Method ' . $method . ' does not exist');
        }

        call_user_func([$this, $method], $request, ...$params);
    }
}