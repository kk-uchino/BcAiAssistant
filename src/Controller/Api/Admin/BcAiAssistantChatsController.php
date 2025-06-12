<?php

namespace BcAiAssistant\Controller\Api\Admin;

use BaserCore\Controller\Api\Admin\BcAdminApiController;
use BaserCore\Utility\BcUtil;
use BcAiAssistant\Service\Admin\BcAiAssistantChatsAdminService;
use BcAiAssistant\Service\Admin\BcAiAssistantLogsAdminService;

/**
 * BcAiAssistantChatsController
 *
 * @property BcAiAssistantChatsAdminService $bcAiAssistantChatsAdminService 
 * @property BcAiAssistantLogsAdminService $bcAiAssistantLogsAdminService
 */
class BcAiAssistantChatsController extends BcAdminApiController
{
    /**
     * initialize
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->bcAiAssistantChatsAdminService = new BcAiAssistantChatsAdminService();
        $this->bcAiAssistantLogsAdminService = new BcAiAssistantLogsAdminService();
    }

    /**
     * OpenAI APIのモデル一覧を取得する
     * 
     * @return void
     */
    public function models(): void
    {
        $this->request->allowMethod(['get']);

        $models = $this->bcAiAssistantChatsAdminService->getModels();

        $this->set('models', $models);
        $this->viewBuilder()->setOption('serialize', 'models');
    }

    /**
     * リクエストを処理する
     *
     * @return void
     */
    public function request(): void
    {
        $this->request->allowMethod(['post']);

        $data = $this->request->getData();
        $model = $data['model'] ?? null;
        $text = $data['text'] ?? null;
        $previousResponseId = $data['previousResponseId'] ?? null;

        $result = [];

        try {
            if ($model && $text) {
                $result = $this->generateBody($model, $text, $previousResponseId);
            } else {
                $result = $this->initChat();
            }
        } catch (\Exception $e) {
            $this->log($e->getMessage(), 'error');

            $result['messages'] = [
                'sender' => 'assistant',
                'parts' => 'text',
                'message' => "エラーが発生しました。\nもう一度お試しください。",
            ];
        }

        $this->set('messages', $result['messages']);
        $this->set('options', $result['options'] ?? []);
        $this->viewBuilder()
            ->setOption('serialize', ['messages', 'options'])
            ->setOption('jsonOptions', JSON_FORCE_OBJECT);
    }

    /**
     * チャットを初期化する
     *
     * @return array
     */
    private function initChat(): array
    {
        return [
            'messages' => [
                [
                    'sender' => 'assistant',
                    'parts' => 'text',
                    'message' => "本文の作成をお手伝いします。\n作成したい記事の内容をテキストエリアに入力してください。",
                ],
            ],
        ];
    }

    /**
     * 本文を生成する
     *
     * @param string $model
     * @param string $text
     * @param string|null $previousResponseId
     * @return array
     */
    private function generateBody(string $model, string $text, string|null $previousResponseId): array
    {
        $tokenLimitCheckResult = $this->checkTokensLimit();
        if ($tokenLimitCheckResult !== true) {
            return $tokenLimitCheckResult;
        }

        $result = $this->bcAiAssistantChatsAdminService->generateBody($model, $text, $previousResponseId);

        return [
            'messages' => [
                [
                    'sender' => 'assistant',
                    'parts' => 'text',
                    'message' => "本文を生成しました。\n内容を確認して、問題なければエディタに反映してください。\n修正したい場合は、修正指示をテキストエリアに入力してください。",
                ],
                [
                    'sender' => 'assistant',
                    'parts' => 'button',
                    'message' => '内容を確認する',
                    'action' => 'preview',
                    'argument' => $result['output_text'] ?? '',
                ],
                [
                    'sender' => 'assistant',
                    'parts' => 'button',
                    'message' => 'エディタに反映する',
                    'action' => 'reflect',
                    'argument' => $result['output_text'] ?? '',
                ],
            ],
            'options' => [
                'responseId' => $result['response_id'] ?? null,
            ],
        ];
    }

    /**
     * トークン制限を確認する
     * 
     * @return array|bool
     */
    private function checkTokensLimit(): array|bool
    {
        $userId = BcUtil::loginUser()['id'];

        if (!$this->bcAiAssistantLogsAdminService->checkTokensLimit($userId)) {
            return [
                'messages' => [
                    [
                        'sender' => 'assistant',
                        'parts' => 'text',
                        'message' => 'トークン制限に達したため、リクエストを処理できません。',
                    ],
                ],
            ];
        }

        return true;
    }
}
