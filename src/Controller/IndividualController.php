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
        var_dump($details);

        if ($details['father_id'] !== null) {
            $parentindividual1 = new IndividualManager();
            $fatherIndividualDog = $parentindividual1->selectDogByID($details['father_id']);
        } else {
            $fatherIndividualDog = null;
        }

        var_dump($fatherIndividualDog);

        if ($details['mother_id'] !== null) {
            $parentindividual2 = new IndividualManager();
            $motherIndividualDog = $parentindividual2->selectDogByID($details['mother_id']);
        } else {
            $motherIndividualDog = null;
        }

        return $this->twig->render('Individual/individual.html.twig', ["details" => $details,
                                                                            "father" => $fatherIndividualDog,
                                                                            "mother" => $motherIndividualDog]);
    }
}
