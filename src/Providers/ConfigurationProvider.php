<?php
declare(strict_types=1);

namespace Pfort\Blog\Providers;

use Pfort\Blog\Config\Configuration;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

final class ConfigurationProvider implements ServiceProviderInterface
{

    public function register(Container $pimple): void
    {
        $pimple[Configuration::class] = fn() => new Configuration(
            ROOT_DIR . '/dev_config.php',
            ROOT_DIR . '/prod_config.php'
        );
    }
}