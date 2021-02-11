<?php

declare(strict_types=1);

namespace App\Controller;

use App\Result\Application\Query\LastResultQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

class ResultController extends AbstractController
{
    /**
     * @Route("/", name="last_result")
     */
    public function index()
    {
        /** @var HandledStamp $response */
        $response  = $this->dispatchMessage(new LastResultQuery())->last(HandledStamp::class);

        return $this->render('result.html.twig', [
            'result' => $response->getResult(),
        ]);
    }
}