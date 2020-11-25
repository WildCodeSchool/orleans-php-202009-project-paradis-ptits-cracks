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

class AdminController extends AbstractController
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
        $dogs = $dogManager->selectLastDogs(5);
        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectLastActualities(5);
        return $this->twig->render('Admin/admin_index.html.twig', ['dogs' => $dogs, 'actualities' => $actualities]);
    }
}
