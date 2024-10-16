<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Http;

readonly final class Request
{
    public function __construct(
        private string $requestMethod,
        private string $requestUri,
    ) {}

    public function getRequestMethod(): string
    {
        return $this->requestMethod;
    }

    public function getRequestUri(): string
    {
        return $this->requestUri;
    }
}