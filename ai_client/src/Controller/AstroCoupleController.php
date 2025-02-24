<?php

namespace App\Controller;

use App\Model\AstroData;
use App\Service\OpenAiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation as REST;

class AstroCoupleController extends AbstractController
{
    #[REST\Route('/', name: 'astro-couple-index', methods: ['POST', 'GET'])]
    public function index(
        OpenAiClient             $openAiClient,
        Request                  $request,
        ValidatorInterface $validator
    ): Response
    {
        // Création des objets pour stocker les données
        $astro1 = new AstroData();
        $astro2 = new AstroData();

        // Création des formulaires
        $form1 = $this->createFormBuilder($astro1)
            ->add('nom', TextType::class, ['label' => 'Nom'])
            ->add('date_naissance', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date et heure de naissance'
            ])
            ->add('lieu_naissance', TextType::class, ['label' => 'Lieu de naissance'])
            ->getForm();

        $form2 = $this->createFormBuilder($astro2)
            ->add('nom', TextType::class, ['label' => 'Nom'])
            ->add('date_naissance', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date et heure de naissance'
            ])
            ->add('lieu_naissance', TextType::class, ['label' => 'Lieu de naissance'])
            ->getForm();

        // Gestion de la soumission des formulaires
        $form1->handleRequest($request);
        $form2->handleRequest($request);

        if ($request->isMethod('POST') && $form1->isSubmitted() && $form1->isValid() && $form2->isSubmitted() && $form2->isValid()) {
            // Validation manuelle des objets
            $errors1 = $validator->validate($astro1);
            $errors2 = $validator->validate($astro2);

            // Si aucune erreur, rediriger vers la page de résultats
            if (count($errors1) === 0 && count($errors2) === 0) {
                return $this->render('index.html.twig', [
                    'personne1' => $astro1,
                    'personne2' => $astro2
                ]);
            }

            // Afficher les erreurs
            foreach ($errors1 as $error) {
                $this->addFlash('error', "Personne 1 : " . $error->getMessage());
            }
            foreach ($errors2 as $error) {
                $this->addFlash('error', "Personne 2 : " . $error->getMessage());
            }
        }

        return $this->render('index.html.twig', [
            'form1' => $form1->createView(),
            'form2' => $form2->createView(),
        ]);
    }
}
