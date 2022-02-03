<?php
/**
 * @author Alexander Kaluzhskiy <alexandr.kaluzhskiy@spiralscout.com>
 */


namespace App\Controller;


use App\Service\VisitCounterSingleKeys;
use App\Service\VisitServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatController extends AbstractController
{

    protected VisitCounterSingleKeys $visitCounter;

    /**
     * VisitController constructor.
     *
     * @param VisitCounterSingleKeys $visitCounter
     */
    public function __construct(VisitCounterSingleKeys $visitCounter)
    {
        $this->visitCounter = $visitCounter;
    }

    /**
     * @Route("/stat/visits", name="stat_visits", methods={"GET"})
     */
    public function getVisitStat()
    {
        return $this->json($this->visitCounter->getVisitStat());
    }
}