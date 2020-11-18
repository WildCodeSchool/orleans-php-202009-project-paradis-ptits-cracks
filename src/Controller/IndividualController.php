<?php

namespace App\Controller;

use App\Model\IndividualManager;

class IndividualController extends AbstractController
{

    /**
     *Display information about a dog according is Id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(int $id)
    {
        $individualdog = new IndividualManager();
        $details = $individualdog->selectDogById($id);
        $parentindividual1= new IndividualManager();
        $fatherIndividualDog = $parentindividual1->selectDogPictureByID($details['father_id']);
        $parentindividual2= new IndividualManager();
        $motherIndividualDog = $parentindividual2->selectDogPictureByID($details['mother_id']);
        return $this->twig->render('Individual/individual.html.twig', ["details" => $details,
                                                                            "father" => $fatherIndividualDog,
                                                                            "mother" => $motherIndividualDog]);
    }
}
