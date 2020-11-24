<?php

namespace App\Controller;

use App\Model\DogManager;

class DogController extends AbstractController
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
    public function show(int $id)
    {
        $individualDog = new DogManager();
        $details = $individualDog->selectDogDataById($id);
        return $this->twig->render('Dog/show.html.twig', ["details" => $details]);
    }
}
