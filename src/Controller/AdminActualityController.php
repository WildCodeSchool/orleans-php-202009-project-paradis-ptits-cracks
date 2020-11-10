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

class AdminActualityController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */

    public function list()
    {
        $actualityManager = new ActualityManager();
        $actualities = $actualityManager->selectAll();

        return $this->twig->render('Admin/list_actuality.html.twig', ['actualities' => $actualities]);
    }
    public function add()
    {
        $errors = [];
        $actuality = [];
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $actuality = array_map('trim', $_POST);
            $errors = $this->validateActuality($actuality);
            if (empty($errors)) {
                $actualityManager = new ActualityManager();
                $actualityManager->saveActuality($actuality);
                header('Location: /AdminActuality/list');
            }
        }
        return $this->twig->render('Admin/add_actuality.html.twig', ['errors' => $errors ?? [],
            'actuality' => $actuality ?? [],]);
    }
    private function validateActuality(array $actuality): array
    {
        $errors = [];

        if (empty($actuality['title'])) {
            $errors [] = 'Le titre ne doit pas être vide.';
        }
            $maxLength = 255;
        if (strlen($actuality['title']) > $maxLength) {
            $errors [] = 'Le titre ne doit pas dépasser ' . $maxLength . ' caractères.';
        }
        if (empty($actuality['date'])) {
            $errors [] = 'La date doit être indiquée.';
        }
        if (empty($actuality['description'])) {
            $errors [] = 'La description ne doit pas être vide.';
        }
            return $errors ?? [];
    }
}
