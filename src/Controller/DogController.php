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
        $dog = new DogManager();
        $details = $dog->selectDogDataById($id);
        if ($details['father_id'] !== null) {
            $father = $dog->selectDogDataById($details['father_id']);
        }
        if ($details['mother_id'] !== null) {
            $mother = $dog->selectDogDataById($details['mother_id']);
        }
        return $this->twig->render('Dog/show.html.twig', [
            "details" => $details,
            "father" => $father ?? [],
            "mother" => $mother ?? [],
            ]);
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
