<?php

declare(strict_types=1);
 
namespace App\Result\Infrastructure;

use App\Result\Domain\ResultRepository;
use App\Result\Domain\Result;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ResultApiRepository implements ResultRepository
{
    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(HttpClientInterface $client, SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    public function getLastResult(): Result
    {
        $response = $this->client->request('GET', 'https://www.fdj.fr/api/service-draws/v1/games/euromillions/draws?include=results,addons&range=0-0');

        $content = $response->getContent();

        return $this->serializer->deserialize($content, 'App\Result\Domain\Result[]', 'json')[0];
    }
}

