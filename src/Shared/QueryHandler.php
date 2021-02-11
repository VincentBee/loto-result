<?php

declare(strict_types=1);

namespace App\Shared;

interface QueryHandler
{
    function handle(Query $query);

    function listenTo(): string;
}
