<?php

namespace App\Controller;

use App\Model\DogManager;

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
        $individualdog = new DogManager();
        $details = $individualdog->selectDogDataById($id);
        return $this->twig->render('Individual/individual.html.twig', ["details" => $details]);
    }
}
