<?php

declare(strict_types=1);

namespace Pfort\Blog\App\Database;

use PDO;

readonly class DbFactory
{
    public function __construct(
        private string $host = '',
        private string $username = '',
        #[\SensitiveParameter]
        private string $password = '',
        private string $database = '',
        private string $charset = '',
    ) {}

    public function create(): Db
    {

        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            rawurlencode($this->host),
            rawurlencode($this->database),
            rawurlencode($this->charset),
        );

        $pdo = new PDO(
            $dsn,
            $this->username,
            $this->password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );

        return new Db($pdo);

    }
}


