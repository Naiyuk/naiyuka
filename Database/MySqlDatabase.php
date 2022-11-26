<?php

declare(strict_types=1);

namespace Framework\Database;

use PDO;

class MySqlDatabase
{
    private PDO $pdo;

    public function __construct(string $dbHost, string $dbName, string $dbUsername, string $dbPassword)
    {
        $config = sprintf('mysql:host=%s;dbname=%s;charset=utf8', $dbHost, $dbName);
        $pdo = new PDO($config, $dbUsername, $dbPassword);

        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->pdo = $pdo;
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}