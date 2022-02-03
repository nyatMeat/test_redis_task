<?php
/**
 * @author Alexander Kaluzhskiy <alexandr.kaluzhskiy@spiralscout.com>
 */


namespace App\Service;


class VisitCounterSingleKeys extends AbstractRedisVisitCounter
{
    public function getVisitStat(): array
    {
        $result = [];
        $countries = $this->redis->smembers($this->makeCountriesSetKey());
        foreach ($countries as $country) {
            $result[$country] = $this->redis->get($this->makeCountryKey($country));
        }

        return $result;
    }

    public function addVisit(string $countryCode): bool
    {
        $countryCode = strtolower($countryCode);
        $this->redis->pipeline()
            ->incr($this->makeCountryKey($countryCode))
            ->sadd($this->makeCountriesSetKey(), [$countryCode])
            ->execute();

        return true;
    }


    protected function makeCountryKey(string $countryCode): string
    {
        return "SNGL_C_VIS:{$countryCode}";
    }

    protected function makeCountriesSetKey(): string
    {
        return 'SNGL_C_SET';
    }


}