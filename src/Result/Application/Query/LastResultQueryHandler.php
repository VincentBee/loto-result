<?php

declare(strict_types=1);

namespace App\Result\Application\Query;

use App\Shared\Query;
use App\Shared\QueryHandler;
use App\Result\Domain\ResultRepository;

class LastResultQueryHandler implements QueryHandler
{
    /**
     * @var ResultRepository
     */
    private $repository;

    public function __construct(ResultRepository $repository)
    {
        $this->repository = $repository;
    }

    function handle(Query $query)
    {
        return $this->repository->getLastResult();
    }

    function listenTo(): string
    {
        return LastResultQuery::class;
    }
}