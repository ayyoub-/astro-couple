<?php

namespace App\Controller;

use App\Entity\AstroCouple;
use App\Form\AstroCoupleType;
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
        OpenAiClient       $openAiClient,
        Request            $request
    ): Response
    {
        $couple = new AstroCouple();
        $form = $this->createForm(AstroCoupleType::class, $couple);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            return $this->render('result.html.twig', [
                'couple' => $couple,
                'resultat' => $openAiClient->getAstrologyAnalysis($couple)
            ]);
        }

        return $this->render('index.html.twig', [
            'form1' => $form->createView()
        ]);
    }
}
