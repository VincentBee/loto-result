<?php

declare(strict_types=1);
 
namespace App\Result\Infrastructure;

use App\Result\Domain\ResultRepository;
use App\Result\Domain\Result;

class ResultNoopRepository implements ResultRepository
{
    public function getLastResult(): Result
    {
        $result = new Result();
        $result->setDate(new \DateTime());
        $result->setCode('1234');
        $result->setNumbers([1, 2, 3, 4, 5]);
        $result->setStars([6, 7]);

        return $result;
    }
}



