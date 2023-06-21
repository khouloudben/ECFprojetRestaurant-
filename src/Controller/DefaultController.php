<?php

namespace App\Controller;
use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(MailerInterface $mailer)
    {
        $email = (new Email())
            ->from('from@example.com')
            ->to('to@example.com')
            ->subject('This e-mail is for testing purpose')
            ->text('This is the text version')
            ->html('<p>This is the HTML version</p>')
        ;

        $mailer->send($email);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    public function getHoraire(HoraireRepository $horaireRepository): Response
    {
        return $this->render('base.html.twig', [
            'horaires' => $horaireRepository->findAll(),
        ]);
    }
}