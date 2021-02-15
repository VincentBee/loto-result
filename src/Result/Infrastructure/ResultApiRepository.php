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

    /**
     * @var string
     */
    private $apiUrl;

    public function __construct(HttpClientInterface $client, SerializerInterface $serializer, string $apiUrl)
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->apiUrl = $apiUrl;
    }

    public function getLastResult(): Result
    {
        $response = $this->client->request('GET', $this->apiUrl);

        $content = $response->getContent();

        return $this->serializer->deserialize($content, 'App\Result\Domain\Result[]', 'json')[0];
    }
}

