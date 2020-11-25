<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\DogManager;

class DogController extends AbstractController
{

    /**
     *Display information about a dog according is Id
     *
     * @param int $id
     *
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

   /**
    * Display home page
    *
    * @return string
    * @throws \Twig\Error\LoaderError
    * @throws \Twig\Error\RuntimeError
    * @throws \Twig\Error\SyntaxError
    */
    public function index()
    {
        $dogManager = new DogManager();
        $males = $dogManager->selectAllAdultType('male');
        $females = $dogManager->selectAllAdultType('female');
        $puppies = $dogManager->selectAllPuppies();
        return $this->twig->render('Dog/index.html.twig', [
        'males' => $males, 'females' => $females, 'puppies' => $puppies,
        ]);
    }
}
