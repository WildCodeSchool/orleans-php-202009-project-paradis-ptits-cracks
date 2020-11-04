<?php

namespace App\Controller;

class LegalController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(): string
    {
        return $this->twig->render('Legal/legal.html.twig');
    }
}
