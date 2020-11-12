<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\ActualityManager;
use App\Model\AgeCategoryManager;
use App\Model\ColorManager;
use App\Model\DogManager;
use App\Model\GenderManager;
use App\Model\StatusManager;

class ActualityController extends AbstractController
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
        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectAll();
        return $this->twig->render('Actuality/index.html.twig', [
        'actualities' => $actualities
        ]);
    }
    public function show(int $id)
    {
        $actualityManager = new ActualityManager();
        $actuality = $actualityManager->selectOneById($id);
        return $this->twig->render('Actuality/show.html.twig', [
            'actuality' => $actuality
        ]);
    }
}
