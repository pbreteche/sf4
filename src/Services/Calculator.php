<?php

namespace App\Services;


use Psr\Log\LoggerInterface;

class Calculator implements CalculatorInterface
{

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger, int $increment)
    {
        $this->logger = $logger;
    }

    public function add(int $a, int $b): int
    {
        $this->logger->debug('call add method', ['a'=> $a, 'b' => $b]);
        return $a + $b;
    }
}