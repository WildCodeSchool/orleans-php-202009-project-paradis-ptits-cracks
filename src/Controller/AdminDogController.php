<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\AgeCategoryManager;
use App\Model\ColorManager;
use App\Model\DogManager;
use App\Model\GenderManager;
use App\Model\StatusManager;

class AdminDogController extends AbstractController
{



    /**
     * Display dog list on admin
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function list()
    {
        $dogManager = new DogManager();
        $dogs = $dogManager->selectAllDogData();

        return $this->twig->render('Admin/list_dog.html.twig', ['dogs' => $dogs]);
    }

    /**
     * Display form to add dog on admin
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @SuppressWarnings(PHPMD)
     */

    public function add()
    {
        $dog = [];
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $dog = array_map('trim', $_POST);
            $errors = $this->validator($dog, $_FILES['picture']);

            if (empty($errors)) {
                $dog['picture'] = $this->addPicture($_FILES['picture']);
                $dogManager = new DogManager();
                $dogManager -> saveDog($dog);
                header('Location: /AdminDog/list');
            }
        }

        $genderManager = new GenderManager();
        $genders = $genderManager->selectAll();

        $statusManager = new StatusManager();
        $statuses = $statusManager -> selectAll();

        $categoryManager = new AgeCategoryManager();
        $categories = $categoryManager -> selectAll();

        $colorManager = new ColorManager();
        $colors = $colorManager -> selectAll();

        $dogManager = new DogManager();
        $dogsAdultMales = $dogManager->selectAllAdultType('male');

        $dogManager = new DogManager();
        $dogsAdultFemales = $dogManager->selectAllAdultType('female');


        return $this->twig->render('Admin/add_dog.html.twig', [
            'genders' => $genders,
            'statuses' => $statuses,
            'colors' => $colors,
            'categories' => $categories,
            'adultMales' => $dogsAdultMales,
            'adultFemales' => $dogsAdultFemales,
            'errors' => $errors,
            'dogData' => $dog,
        ]);
    }

    /**
     * Display form to edit dog on admin
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @SuppressWarnings(PHPMD)
     */

    public function edit(int $id)
    {
        $errors = [];

        $genderManager = new GenderManager();
        $genders = $genderManager->selectAll();

        $statusManager = new StatusManager();
        $statuses = $statusManager -> selectAll();

        $categoryManager = new AgeCategoryManager();
        $categories = $categoryManager -> selectAll();

        $colorManager = new ColorManager();
        $colors = $colorManager -> selectAll();

        $dogManager = new DogManager();
        $dogsAdultMales = $dogManager->selectAllAdultType('male');
        $dogsAdultFemales = $dogManager->selectAllAdultType('female');
        $dog = $dogManager->selectDogDataById($id);
        $initialImage = $dog['picture'];



        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $dog = array_map('trim', $_POST);
            $errors = $this->validator($dog, $_FILES['picture']);

            if (empty($errors)) {
                if (!empty($_FILES['picture']['tmp_name'])) {
                    $dog['picture'] = $this->addPicture($_FILES['picture']);
                    unlink('uploads/' . $initialImage);
                } else {
                    $dog['picture'] = $initialImage;
                }

                $dogManager = new DogManager();
                $dogManager -> editDog($dog, $id);
                header('Location: /AdminDog/show/' . $id);
            }
        }

        return $this->twig->render('Admin/edit_dog.html.twig', [
            'genders' => $genders,
            'statuses' => $statuses,
            'colors' => $colors,
            'categories' => $categories,
            'adultMales' => $dogsAdultMales,
            'adultFemales' => $dogsAdultFemales,
            'errors' => $errors,
            'dogData' => $dog,
        ]);
    }

    /**
     * Display dog details on admin
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function show(int $id)
    {
        $dogManager = new dogManager();
        $dog = $dogManager->selectDogDataById($id);
        $children = $dogManager->howManyPuppies($id);
        return $this->twig->render('Admin/show_dog.html.twig', ['dog' => $dog, 'children' => $children]);
    }

    /**
     * Delete dog from de database
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST['id'];
            $dogManager = new dogManager();
            $dogManager->deleteDog($id);
            header('Location:/AdminDog/list');
        }
    }

    /**
     * Form post validation
     *
     * @param array $dog
     * @param array $file
     * @return array $errors
     * @SuppressWarnings(PHPMD)
     */

    private function validator(array $dog, array $file): array
    {
        $errors = [];
        $maxLengthShort = 100;
        $maxLengthLong = 255;
        $maxSize = 1000000;
        $authorizedMimes = ['image/jpeg', 'image/png'];

        if (empty($dog['age_category'])) {
            $errors['age_category'] = 'Veuillez sélectionner une catégorie';
        }

        if (empty($dog['status_select'])) {
            $errors['status_select'] = 'Veuillez sélectionner un statut';
        }

        if (empty($dog['name'])) {
            $errors['name1'] = 'Veuillez ajouter un nom';
        } elseif (strlen($dog['name']) > $maxLengthShort) {
            $errors['name2'] = 'Le nom ne doit pas dépasser ' . $maxLengthShort . ' caractères.';
        }

        if (empty($dog['birthday'])) {
            $errors['birthday'] = 'Veuillez ajouter la date de naissance';
        }

        if (empty($dog['gender'])) {
            $errors['gender'] = 'Veuillez préciser le sexe du chien';
        }

        if (empty($dog['color_select'])) {
            $errors['color_select'] = 'Veuillez préciser la couleur du chien';
        }

        if (!empty($dog['chien_de_france'])) {
            if (!filter_var($dog['chien_de_france'], FILTER_VALIDATE_URL)) {
                $errors['chien_de_france2'] = 'Merci d\'ajouter une url valide vers www.chiens-de-france.com';
            }

            if (!strstr($dog['chien_de_france'], 'chiens-de-france')) {
                $errors['chien_de_france2'] = 'Merci d\'ajouter une url valide vers www.chiens-de-france.com';
            }

            if (strlen($dog['chien_de_france']) > $maxLengthLong) {
                $errors['chien_de_france'] = 'Le lien ne doit pas dépasser ' . $maxLengthLong . ' caractères.';
            }
        }

        if (strlen($dog['lof_number']) > $maxLengthShort) {
            $errors['lof_number'] = 'Le numéro de lof ne doit pas dépasser ' . $maxLengthShort . ' caractères.';
        }

        if ($file['size'] > $maxSize) {
            $errors['picture'] = 'Le fichier ne doit pas excéder ' . floor($maxSize / 1000000) . ' Mo';
        }

        if (!empty($file['tmp_name']) && !in_array(mime_content_type($file['tmp_name']), $authorizedMimes)) {
            $errors['picture2'] = 'Le fichier doit être de type png ou jpeg';
        }
        return $errors;
    }

    private function addPicture($picture): string
    {
        $filename = uniqid() . '.' . pathinfo($picture['name'], PATHINFO_EXTENSION);
        move_uploaded_file($picture['tmp_name'], 'uploads/' . $filename);
        return $filename;
    }
}
