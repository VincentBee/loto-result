<?php

declare(strict_types=1);

namespace App\Shared;

class QueryDispatcherHandler implements QueryBusHandler
{
    /**
     * @var QueryHandler[]
     */
    private $handlers;

    public function __construct(iterable $handlers)
    {
        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    function __invoke(Query $query)
    {
        $queryClass= get_class($query);
        $handler = $this->handlers[$queryClass];

        if ($handler == null) {
            throw new \Exception("Query handler for $queryClass not found.");
        }

        return $handler->handle($query);
    }
}
