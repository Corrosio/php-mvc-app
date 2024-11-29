<?php
declare(strict_types=1);

namespace Pfort\Blog\Providers;

use Pfort\Blog\App\Database\Db;
use Pfort\Blog\App\Database\DbFactory;
use Pfort\Blog\Config\Configuration;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

final class DatabaseProvider implements ServiceProviderInterface
{

    public function register(Container $pimple): void
    {
        $config = $pimple[Configuration::class];

        $pimple[Db::class] = function () use ($config) {
            $db = new DbFactory(
                $config->get('database.host'),
                $config->get('database.username'),
                $config->get('database.password'),
                $config->get('database.databaseName'),
                $config->get('database.charset')
            );

            return $db->create();
        };
    }
}