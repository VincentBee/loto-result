<?php

declare(strict_types=1);

namespace App\Tests\Result\Application\Query;

use App\Result\Application\Query\LastResultQuery;
use App\Result\Application\Query\LastResultQueryHandler;
use App\Result\Domain\Result;
use App\Result\Domain\ResultRepository;
use PHPUnit\Framework\TestCase;

/**
 * Integration test for LastResultQueryHandler
 */
class LastResultQueryHandlerTest extends TestCase
{
    public function testCallRepositoryToHandleQuery()
    {
        // GIVEN
        $expectedResult = new Result();
        $expectedResult->setDate(new \DateTime());
        $expectedResult->setCode('1234');
        $expectedResult->setNumbers([1, 2, 3, 4, 5]);
        $expectedResult->setStars([6, 7]);

        $query = new LastResultQuery();

        $repository = $this->createMock(ResultRepository::class);
        $repository
            ->method('getLastResult')
            ->willReturn($expectedResult);

        $handler = new LastResultQueryHandler($repository);

        // WHEN
        $response = $handler->handle($query);

        // THEN
        $this->assertEquals($expectedResult, $response);
    }
}