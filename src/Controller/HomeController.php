<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\ActualityManager;
use App\Model\DogManager;

class HomeController extends AbstractController
{

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
        $puppies = $dogManager->selectThreePuppies();
        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectTwoLastActualities();
        return $this->twig->render('Home/index.html.twig', ['puppies' => $puppies, 'actualities' => $actualities]);
    }
}
