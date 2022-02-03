<?php
/**
 * @author Alexander Kaluzhskiy <alexandr.kaluzhskiy@spiralscout.com>
 */


namespace App\Service;


use Predis\Client;
use Psr\Log\LoggerInterface;

abstract class AbstractRedisVisitCounter implements VisitServiceInterface
{
    protected Client $redis;
    protected LoggerInterface $logger;

    /**
     * VisitCounterService constructor.
     *
     * @param Client          $redis
     * @param LoggerInterface $logger
     */
    public function __construct(Client $redis, LoggerInterface $logger)
    {
        $this->redis = $redis;
        $this->logger = $logger;
    }
}