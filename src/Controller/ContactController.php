<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact_index')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Créez le contenu de l'email
            $emailContent = $this->renderView('contact/template.twig.html', [
                'email' => $contact->getEmail(),
                'name' => $contact->getName()
            ]);

            // Créez l'objet Email
            $email = (new Email())
                ->from('no-reply@monsupersite.com')
                ->to('contact@monsupersite.com')
                ->subject('Une demande de contact a été faite')
                ->html($emailContent);

            $mailer->send($email);

            $this->addFlash('success', 'Message envoyé avec succès !');
            return $this->redirectToRoute('app_contact_index');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
