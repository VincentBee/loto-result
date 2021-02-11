<?php

declare(strict_types=1);
 
namespace App\Result\Domain;

interface ResultRepository
{
    function getLastResult(): Result;
}
