<?php
/**
 * @author Alexander Kaluzhskiy <alexandr.kaluzhskiy@spiralscout.com>
 */


namespace App\Service;


interface VisitServiceInterface
{
    public function addVisit(string $countryCode): bool;


    public function getVisitStat(): array;
}