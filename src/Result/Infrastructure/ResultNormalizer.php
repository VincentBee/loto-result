<?php

declare(strict_types=1);

namespace App\Result\Infrastructure;

use App\Result\Domain\Result;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;

class ResultNormalizer implements ContextAwareDenormalizerInterface
{
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $results = [];

        foreach ($data as $dataItem) {
            $values = array_map(function ($item) {
                return intval($item['value']);
            }, $dataItem['results']);

            $result = new Result();
            $result
                ->setDate(new \DateTime($dataItem['drawn_at']))
                ->setCode($dataItem['addons'][0]['value'])
                ->setNumbers(array_slice($values, 0, 5))
                ->setStars(array_slice($values, 5, 2))
            ;

            $results[] = $result;
        }

        return $results;
    }

    public function supportsDenormalization($data, string $type, string $format = null, array $context = [])
    {
        return $type === 'App\Result\Domain\Result[]';
    }
}
