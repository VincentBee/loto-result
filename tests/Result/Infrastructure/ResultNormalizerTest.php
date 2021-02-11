<?php

declare(strict_types=1);

namespace App\Tests\Result\Infrastructure;

use App\Result\Domain\Result;
use App\Result\Infrastructure\ResultNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Unit test for ResultNormalizer
 */
class ResultNormalizerTest extends TestCase
{
    public function testTransformJsonIntoResult()
    {
        // GIVEN
        $expectedResult = new Result();
        $expectedResult->setDate(new \DateTime("2021-02-09T21:30:00+01:00"));
        $expectedResult->setCode('ME 065 0382');
        $expectedResult->setNumbers([1, 2, 3, 4, 5]);
        $expectedResult->setStars([6, 7]);

        $data = [
            [
                "drawn_at" => "2021-02-09T21:30:00+01:00",
                "results" => [
                    ["value" => "1"],
                    ["value" => "2"],
                    ["value" => "3"],
                    ["value" => "4"],
                    ["value" => "5"],
                    ["value" => "6"],
                    ["value" => "7"],
                ],
                "addons" => [
                    ["value" => "ME 065 0382"]
                ]
            ]
        ];

        $normalizer = new ResultNormalizer();

        // WHEN
        $response = $normalizer->denormalize($data, Result::class);

        // THEN
        $this->assertEquals([$expectedResult], $response);
    }
}
