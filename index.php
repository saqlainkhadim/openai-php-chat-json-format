<?php

/**
 * Made with ❤️ by saqlain khadim 
 * Lets connect https://www.linkedin.com/in/saqlainkhadim/
 */

require __DIR__ . '/vendor/autoload.php';

// docs https://platform.openai.com/docs/quickstart/step-3-sending-your-first-api-request
$payload = [
    'model' => 'gpt-3.5-turbo-1106',
    'response_format' => ['type' => 'json_object'],
    'messages' => [
        [
            'role' => 'system',
            'content' => 'You are a helpful assistant that generates quiz questions based on a topic. Respond with one short question and three plausible options/answers, of which only one is correct. Provide your answer in JSON structure like this {"topic": "<The topic of the quiz>", "question": "<The quiz question you generate>", "options": {"option1": {"body": "<Plausible option 1>", "isItCorrect": <true or false>}, "option2": {"body": "<Plausible option 2>", "isItCorrect": <true or false>}, "option3": {"body": "<Plausible option 3>", "isItCorrect": <true or false>}}}',
        ],
        [
            'role' => 'user',
            'content' => 'Provide a question with three possible answers about: The Premier League',
        ],
        [
            'role' => 'assistant',
            'content' => '{"topic": "Premier League location", "question": "Where is the Premier League played?", "options": {"option1": {"body": "France", "isItCorrect": false}, "option2": {"body": "England", "isItCorrect": true}, "option3": {"body": "Sweden", "isItCorrect": false}}}',
        ],
        [
            'role' => 'user',
            'content' => 'Provide a question with three possible answers about: ' . "WHAT IS YOUR HELATH",
        ],
    ],
];

// get api key from https://platform.openai.com/api-keys
$yourApiKey = 'Your OPENAI_KEY';
// rest api for http requests https://api.openai.com/v1/chat/completions
// library https://github.com/openai-php/client
$client = \OpenAI::client($yourApiKey);

$result = $client->chat()->create($payload);

return json_decode($result->choices[0]->message->content);
