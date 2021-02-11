<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Functional test for ResultController
 */
class ResultControllerTest extends WebTestCase
{
    public function testDisplayResult()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('.subtitle', 'Résultats EuroMillions - My Million');
        $this->assertCount(5, $crawler->filter('.item.number'));
        $this->assertCount(2, $crawler->filter('.item.star'));
    }
}