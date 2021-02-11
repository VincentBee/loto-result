<?php

declare(strict_types=1);

namespace App\Shared;

use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class QueryLoggerMiddleware implements MiddlewareInterface
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Envelope $query, StackInterface $stack): Envelope
    {
        $queryClass = get_class($query);
        $startTime = microtime(true);

        $response = $stack->next()->handle($query, $stack);

        $endTime = microtime(true);
        $elapsed = $endTime - $startTime;

        $this->logger->info("Query $queryClass took $elapsed");

        return $response;
    }
}
