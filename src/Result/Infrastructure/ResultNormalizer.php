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
            $numberValues = array_values(array_map(function ($item) {
                return intval($item['value']);
            }, array_filter($dataItem['results'], function ($item) {
                return $item['type'] === 'number';
            })));

            $starValues = array_values(array_map(function ($item) {
                return intval($item['value']);
            }, array_filter($dataItem['results'], function ($item) {
                return $item['type'] === 'special';
            })));

            $result = new Result();
            $result
                ->setDate(new \DateTime($dataItem['drawn_at']))
                ->setCode($dataItem['addons'][0]['value'])
                ->setNumbers($numberValues)
                ->setStars($starValues)
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
