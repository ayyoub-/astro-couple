<?php

namespace App\Service;

use OpenAI\Client;
use OpenAI\Responses\Chat\CreateResponse;

class OpenAiClient
{
    public function __construct(
        private Client $client,
    )
    {
    }

    public function guessInfluencers(string $request): array
    {
        /** @var CreateResponse $response */
        $response = $this->client->chat()->create([
            'model' => 'gpt-4o',
            'messages' => [
                ['role' => 'system', 'content' => "You are an API like HypeAuditor, InfluencerDB specialized in retrieving real and publicly available information about Instagram accounts. Your primary role is to provide accurate and verified details about existing accounts based on the specified criteria. Do not fabricate or provide information about non-existent accounts. Only return information that is publicly accessible and verifiable."],
                ['role' => 'user', 'content' => $request],
            ],
            'max_tokens' => 2000,
        ]);
        dd($response->choices[0]->message->content);
        return ['Service works'];
    }
}