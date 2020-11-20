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
            $errors = $this->validateActuality($actuality, $_FILES['image']);

            if (empty($errors)) {
                $filename = uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $filename);
                $actuality['image'] = $filename;
                $actualityManager = new ActualityManager();
                $actualityManager->saveActuality($actuality);
                header('Location: /AdminActuality/list');
            }
        }
        return $this->twig->render('Admin/add_actuality.html.twig', ['errors' => $errors ?? [],
            'actuality' => $actuality ?? [],]);
    }

    /**
     * @param array $actuality
     * @param array $file
     * @return array
     */

    private function validateActuality(array $actuality, array $file): array
    {
        $errors = [];
        $maxSize = 1000000;
        $authorizedMimes = ['image/jpeg', 'image/png'];

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
        if ($file['size'] > $maxSize) {
            $errors [] = 'L\'image est trop volumineuse, elle ne doit pas dépasser' . $maxSize / 1000000 . ' Mo.';
        }
        if (!in_array(mime_content_type($file['tmp_name']), $authorizedMimes)) {
            $errors[] = 'Le fichier doit être de type png ou jpeg';
        }
        return $errors ?? [];
    }
    public function edit(int $id)
    {
        $actuality = [];
        $actualityManager = new ActualityManager();
        $actuality = $actualityManager->selectOneById($id);

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $actuality = array_map('trim', $_POST);
            $errors = $this->validateActuality($actuality, $_FILES['image']);

            if (empty($errors)) {
                $actuality = $actualityManager->editActuality($actuality, $id);
                header('Location: /AdminActuality/list');
            }
        }
        return $this->twig->render('Admin/edit_actuality.html.twig', ['actuality' => $actuality]);
    }
    public function show(int $id)
    {
        $actualityManager = new ActualityManager();
        $actuality = $actualityManager->selectOneById($id);
        return $this->twig->render('Admin/show_actuality.html.twig', ['actuality' => $actuality]);
    }
    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST['id'];
            $actualityManager = new actualityManager();
            $actualityManager->deleteActuality($id);
            header('Location:/AdminActuality/list');
        }
    }
}
