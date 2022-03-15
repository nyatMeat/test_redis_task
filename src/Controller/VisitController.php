<?php
/**
 * @author Alexander Kaluzhskiy <alexandr.kaluzhskiy@spiralscout.com>
 */


namespace App\Controller;


use App\Service\VisitCounterSingleKeys;
use App\Service\VisitServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisitController extends AbstractController
{

    protected VisitServiceInterface $visitCounter;

    /**
     * VisitController constructor.
     *
     * @param VisitServiceInterface $visitCounter
     */
    public function __construct(VisitServiceInterface $visitCounter)
    {
        $this->visitCounter = $visitCounter;
    }


    /**
     * @Route("/visit/{countryCode}", name="visit", methods={"POST"})
     * @param $countryCode
     */
    public function visit($countryCode)
    {
        $this->visitCounter->addVisit($countryCode);
        return new Response();
    }

}
