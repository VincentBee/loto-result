<?php

declare(strict_types=1);

namespace App\Shared;

interface QueryBusHandler
{
    function __invoke(Query $query);
}
