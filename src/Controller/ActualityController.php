<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\ActualityManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ActualityController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */

    public function index()
    {
        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectAll();
        return $this->twig->render('Actuality/index.html.twig', [
            'actualities' => $actualities
        ]);
    }
}
