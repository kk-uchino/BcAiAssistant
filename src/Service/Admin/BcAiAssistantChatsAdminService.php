<?php

namespace BcAiAssistant\Service\Admin;

use BaserCore\Utility\BcUtil;
use BcAiAssistant\Model\Entity\BcAiAssistantSetting;
use BcAiAssistant\Service\Admin\BcAiAssistantLogsAdminService;
use BcAiAssistant\Utility\OpenAiApi;
use Cake\Utility\Hash;

/**
 * BcAiAssistantChatsAdminService
 *
 * @property BcAiAssistantSetting|null $setting
 * @property BcAiAssistantLogsAdminService $bcAiAssistantLogsAdminService
 */
class BcAiAssistantChatsAdminService
{
    public function __construct()
    {
        $this->setting = (new BcAiAssistantSettingsAdminService())->getSetting();
        $this->bcAiAssistantLogsAdminService = new BcAiAssistantLogsAdminService();
    }

    /**
     * モデルの一覧を取得する
     * 
     * @return array
     */
    public function getModels(): array
    {
        $client = new OpenAiApi($this->setting->openai_api_key);
        $models = $client->models();
        return Hash::extract($models, '{*}.id');
    }

    /**
     * 本文を生成する
     *
     * @param string $model
     * @param string $input
     * @param string|null $previousResponseId
     * @return array
     */
    public function generateBody(string $model, string $input, string|null $previousResponseId): array
    {
        $instructions = $this->setting->generate_body_instructions ?? "";
        $client = new OpenAiApi($this->setting->openai_api_key);
        $response = $client->responses($model, $instructions, $input, $previousResponseId);
        $output = $response['output'][0]['content'][0]['text'];

        $this->bcAiAssistantLogsAdminService->saveLog([
            'user_id' => BcUtil::loginUser()->id ?? null,
            'response_id' => $response['id'],
            'previous_response_id' => $response['previous_response_id'] ?? null,
            'model' => $model,
            'request' => $input,
            'response' => $output,
            'input_tokens' => $response['usage']['input_tokens'] ?? 0,
            'output_tokens' => $response['usage']['output_tokens'] ?? 0,
            'total_tokens' => $response['usage']['total_tokens'] ?? 0,
            'created' => date('Y-m-d H:i:s'),
        ]);

        return [
            'response_id' => $response['id'],
            'output_text' => $response['output'][0]['content'][0]['text'],
        ];
    }
}
