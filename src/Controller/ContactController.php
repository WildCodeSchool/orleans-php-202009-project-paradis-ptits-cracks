<?php

namespace App\Controller;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact = array_map('trim', $_POST);
            $errors = $this->validateContact($contact);

            if (empty($errors)) {
                $transport = Transport::fromDsn(MAILER_DSN);
                $mailer = new Mailer($transport);
                $email = (new Email())
                    ->from($contact['email'])
                    ->to(MAIL_TO)
                    ->subject('Message du site le paradis des petits cracks')
                    ->html($this->twig->render('Contact/email.html.twig', ['contact' => $contact,]));
                $mailer->send($email);
//                $this->session->set('notification', 'Le mail a bien été envoyé');
                header("Location: /Home/index");
                return 'Redirection to home';
            }
        }
        return $this->twig->render('Contact/contact.html.twig', [
            'errors' => $errors ?? [],
            'contact' => $contact ?? [],
        ]);
    }
    private function validateContact($contact): array
    {
        $errors = [];

        if (empty($contact['lastname'])) {
            $errors['lastname'] = "Veuillez remplir le champ nom";
        }
        if (empty($contact['firstname'])) {
            $errors['firstname'] = "Veuillez remplir le champ prénom";
        }
        if (empty($contact['email'])) {
            $errors['email'] = "Veuillez remplir le champ email";
        } elseif (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Format invalide d'email";
        }
        if (empty($contact['message'])) {
            $errors['message'] = "Veuillez remplir le champ message";
        }

        return $errors;
    }
}
