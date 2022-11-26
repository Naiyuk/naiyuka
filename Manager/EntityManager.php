<?php

declare(strict_types=1);

namespace Framework\Manager;

use Framework\Database\MySqlDatabase;

abstract class EntityManager
{
    public function __construct(protected MySqlDatabase $database) {}
}