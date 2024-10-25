<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Controller;

use Pfort\Blog\App\Http\Request;

interface ControllerInterface
{
    public function execute(Request $request, string $method, array $params=[]): void;
}