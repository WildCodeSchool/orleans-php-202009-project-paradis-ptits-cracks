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
     * Display dog page on admin
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
            $errors = $this->validator($dog);

            if (empty($errors)) {
                $dogManager = new DogManager();
                $dogManager -> saveDog($dog);
                header('Location: /AdminDog/add');
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
        $dogsAdultMales = $dogManager->selectAllAdultMales();

        $dogManager = new DogManager();
        $dogsAdultFemales = $dogManager->selectAllAdultFemales();

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
     * Form post validation
     *
     * @param array $dog
     * @return array $errors
     * @SuppressWarnings(PHPMD)
     */
    private function validator(array $dog): array
    {
        $errors = [];
        $maxLengthShort = 100;
        $maxLengthLong = 255;

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

        if (empty($dog['picture'])) {
            $errors['picture'] = 'Veuillez ajouter une photo';
        }

        if (!filter_var($dog['picture'], FILTER_VALIDATE_URL)) {
            $errors['picture2'] = 'Merci d\'ajouter une url valide pour la photo';
        }

        if (strlen($dog['picture']) > $maxLengthLong) {
            $errors['picture3'] = 'Le lien ne doit pas dépasser ' . $maxLengthLong . ' caractères.';
        }

        if (empty($dog['gender'])) {
            $errors['gender'] = 'Veuillez préciser le sexe du chien';
        }

        if (empty($dog['color_select'])) {
            $errors['color_select'] = 'Veuillez préciser la couleur du chien';
        }

        if (!filter_var($dog['chien_de_france'], FILTER_VALIDATE_URL)) {
            $errors['chien_de_france2'] = 'Merci d\'ajouter une url valide vers www.chiens-de-france.com';
        }

        if (!strstr($dog['chien_de_france'], 'chiens-de-france')) {
            $errors['chien_de_france2'] = 'Merci d\'ajouter une url valide vers www.chiens-de-france.com';
        }

        if (strlen($dog['chien_de_france']) > $maxLengthLong) {
            $errors['chien_de_france'] = 'Le lien ne doit pas dépasser ' . $maxLengthLong . ' caractères.';
        }

        if (strlen($dog['lof_number']) > $maxLengthShort) {
            $errors['lof_number'] = 'Le numéro de lof ne doit pas dépasser ' . $maxLengthShort . ' caractères.';
        }

        return $errors;
    }
}
