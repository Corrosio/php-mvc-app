<?php
declare(strict_types=1);

namespace Pfort\Blog\Config;

use Pfort\Blog\Config\ConfigInterface;

readonly final class Configuration implements ConfigInterface
{
    private array $config;

    public function __construct(
        private string $devConfig,
        private string $prodConfig,
    ) {
        $config = getenv("APP_ENV") === 'development' ? $devConfig : $prodConfig;
        $this->config = include $config;
    }

    public function get(string $path): string|int|float|bool|null
    {
        $config = $this->config;
        $keys = explode('.', $path);
        foreach ($keys as $key) {
            if (!isset($config[$key])) {
                return null;
            }

            $config = $config[$key];
        }

        return $config;
    }
}