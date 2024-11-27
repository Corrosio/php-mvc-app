<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Controller;

use Pfort\Blog\App\Exceptions\ControllerException;
use Pfort\Blog\App\Http\Request;
use Pfort\Blog\View\View;


abstract class BaseController implements ControllerInterface
{
    #[Inject(View::class)]
    protected View $view;

    #[Inject(Request::class)]
    protected Request $request;

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

    protected function render(string $template, array $context = []): void
    {
        echo $this->view->render($template, $context);
    }
}