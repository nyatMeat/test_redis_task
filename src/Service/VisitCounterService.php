<?php
/**
 * @author Alexander Kaluzhskiy <alexandr.kaluzhskiy@spiralscout.com>
 */


namespace App\Service;


class VisitCounterService extends AbstractRedisVisitCounter
{

    public function addVisit(string $countryCode): bool
    {
        try {
            return (bool)$this->redis->hincrby($this->getVisitsKey(), strtolower($countryCode), 1);
        } catch (\Exception $e) {
            $this->logger->error('Something went wrong while logging visit', [
                'error'       => $e->getMessage(),
                'trace'       => $e->getTraceAsString(),
                'countryCode' => $countryCode
            ]);
            throw $e;
        }
    }

    public function getVisitStat(): array
    {
        try {
            return $this->redis->hgetall($this->getVisitsKey());

        } catch (\Exception $e) {
            $this->logger->error('Something went wrong while getting stat', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }

    }

    public function getVisitsKey(): string
    {
        return 'COUNTRY_VISIT';
    }
}