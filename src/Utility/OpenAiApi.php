<?php

namespace BcAiAssistant\Utility;

use Cake\Http\Client;

/**
 * OpenAiApi
 * 
 * @property string $apiKey
 * @property string $model
 */
class OpenAiApi
{
    private const API_URL = 'https://api.openai.com';
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * models API
     *
     * @return array
     */
    public function models(): array
    {
        $endpoint = '/v1/models';
        $response = $this->sendGetRequest($endpoint);
        return $response['data'];
    }

    /**
     * responses API
     *
     * @param string $model
     * @param string $instructions
     * @param string $input
     * @param string|null $previousResponseId
     * @return array
     */
    public function responses(string $model, string $instructions, string $input, string|null $previousResponseId = null): array
    {
        $endpoint = '/v1/responses';
        $data = [
            'model' => $model,
            'instructions' => $instructions,
            'input' => $input,
            'store' => true,
        ];
        if ($previousResponseId) {
            $data['previous_response_id'] = $previousResponseId;
        }
        $response = $this->sendPostRequest($endpoint, $data);
        if ($response['error']) {
            throw new \Exception($response['error']['message']);
        }
        return $response;
    }

    /**
     * GETリクエストを送信する
     *
     * @param string $endpoint
     * @return mixed
     */
    private function sendGetRequest(string $endpoint): mixed
    {
        $http = new Client();
        $response = $http->get(self::API_URL . $endpoint, [], [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
        ]);
        return $response->getJson();
    }

    /**
     * POSTリクエストを送信する
     *
     * @param string $endpoint
     * @param array $data
     * @return mixed
     */
    private function sendPostRequest(string $endpoint, array $data): mixed
    {
        $http = new Client();
        $response = $http->post(self::API_URL . $endpoint, json_encode($data), [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
        ]);
        return $response->getJson();
    }
}
