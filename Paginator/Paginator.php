<?php

declare(strict_types=1);

namespace Framework\Paginator;

class Paginator
{
    public function paginate(string $query, int $page, int $limit): string
    {
        --$page;

        if ($page < 0) {
            $page = 0;
        }

        $offset = $page * $limit;

        $query .= sprintf(' LIMIT %s OFFSET %s', $limit, $offset);

        return $query;
    }
}