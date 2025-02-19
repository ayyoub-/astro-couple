<?php

namespace App\Controller;

use App\Service\OpenAiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation as REST;

class AstroCoupleController extends AbstractController
{
    #[REST\Route('/', name: 'astro-couple-index', methods: ['GET'])]
    public function index(
        OpenAiClient $openAiClient,
        Request $request,
    ): Response
    {
        // Création des formulaires pour deux personnes
        $form1 = $this->createFormBuilder()
            ->add('nom', TextType::class, ['label' => 'Nom'])
            ->add('date_naissance', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date et heure de naissance'
            ])
            ->add('lieu_naissance', TextType::class, ['label' => 'Lieu de naissance'])
            ->getForm();

        $form2 = $this->createFormBuilder()
            ->add('nom', TextType::class, ['label' => 'Nom'])
            ->add('date_naissance', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date et heure de naissance'
            ])
            ->add('lieu_naissance', TextType::class, ['label' => 'Lieu de naissance'])
            ->add('submit', SubmitType::class, ['label' => 'Générer la carte astrologique'])
            ->getForm();

        return $this->render('index.html.twig', [
            'form1' => $form1->createView(),
            'form2' => $form2->createView(),
        ]);
    }
}
