<?php

declare(strict_types=1);
 
namespace App\Result\Domain;

class Result
{
    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $code;

    /**
     * @var integer[]
     */
    private $numbers;

    /**
     * @var integer[]
     */
    private $stars;

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setNumbers(array $numbers): self
    {
        $this->numbers = $numbers;
        return $this;
    }

    public function getNumbers(): array
    {
        return $this->numbers;
    }

    public function setStars(array $stars): self
    {
        $this->stars = $stars;
        return $this;
    }

    public function getStars(): array
    {
        return $this->stars;
    }
}