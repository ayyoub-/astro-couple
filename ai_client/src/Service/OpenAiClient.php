<?php

namespace App\Service;

use App\Entity\AstroCouple;
use OpenAI\Client;
use OpenAI\Responses\Chat\CreateResponse;

class OpenAiClient
{
    public function __construct(
        private Client $client,
    )
    {
    }

    public function getAstrologyAnalysis(AstroCouple $astroCouple): ?string
    {
        $prompt = "
        Voici les informations concernant deux personnes pour une analyse astrologique de leur compatibilité :

        Personne 1 :
        - Nom : {$astroCouple->getNom1()}
        - Date et heure de naissance : {$astroCouple->getDateNaissance1()->format('Y-m-d H:i')}
        - Lieu de naissance : {$astroCouple->getLieuNaissance1()}

        Personne 2 :
        - Nom : {$astroCouple->getNom2()}
        - Date et heure de naissance : {$astroCouple->getDateNaissance2()->format('Y-m-d H:i')}
        - Lieu de naissance : {$astroCouple->getLieuNaissance2()}
        ### Instruction :
        Génère une analyse astrologique de leur compatibilité, en mettant en évidence les points forts, les points faibles, et un score global de compatibilité entre les deux. Indique également les aspects astrologiques clés qui influencent cette relation.
        il faut bien remplacé Personne1 et Personne2 par les noms fournis.

        ### Format de réponse :
        Présente la réponse sous forme de code HTML structuré et bien formaté pour un affichage facile sur une page web sans les balises (html, head et body). et tu peux utiliser des icones pour rendre le résultat plus beaux";

        // Appel à l'API OpenAI pour générer une réponse astrologique
        $response = $this->client->chat()->create([
            'model' => 'gpt-4o',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Vous êtes un astrologue expert qui génère des analyses astrologiques détaillées et précises.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => 1000
        ]);



        return $response->choices[0]->message->content;
    }
}