<?php
declare(strict_types=1);

namespace Pfort\Blog\App\Controller;

#[\Attribute]
readonly final class Inject
{
    public function __construct(private string $serviceName)
    {
    }

    public function getServiceName(): string {
        return $this->serviceName;
    }
}