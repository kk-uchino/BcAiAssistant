<?php

namespace BcAiAssistant\Service\Admin;

use BcAiAssistant\Model\Entity\BcAiAssistantLog;
use BcAiAssistant\Model\Entity\BcAiAssistantSetting;
use BcAiAssistant\Model\Table\BcAiAssistantLogsTable;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\TableRegistry;

/**
 * BcAiAssistantLogsAdminService
 *
 * @property BcAiAssistantLogsTable $bcAiAssistantLogsTable
 * @property BcAiAssistantSetting|null $setting
 */
class BcAiAssistantLogsAdminService
{
    public function __construct()
    {
        $this->bcAiAssistantLogsTable = TableRegistry::getTableLocator()->get('BcAiAssistant.BcAiAssistantLogs');
        $this->setting = (new BcAiAssistantSettingsAdminService())->getSetting();
    }

    /**
     * 生成ログのクエリーを取得する
     *
     * @param array $queryParams
     * @return SelectQuery
     */
    public function getLogsQuery(array $queryParams = []): SelectQuery
    {
        $query = $this->bcAiAssistantLogsTable->find()->contain(['Users']);

        if (!empty($queryParams['limit'])) {
            $query->limit($queryParams['limit']);
        }

        if (!empty($queryParams['user_id'])) {
            $query->where(['BcAiAssistantLogs.user_id' => $queryParams['user_id']]);
        }
        if (!empty($queryParams['created_start'])) {
            $startDate = $queryParams['created_end'] . ' 00:00:00';
            $query->where(['BcAiAssistantLogs.created >=' => $startDate]);
        }
        if (!empty($queryParams['created_end'])) {
            $endDate = $queryParams['created_end'] . ' 23:59:59';
            $query->where(['BcAiAssistantLogs.created <=' => $endDate]);
        }

        return $query;
    }

    /**
     * OpenAI APIのログを保存する
     *
     * @param array $data
     * @return BcAiAssistantLog
     */
    public function saveLog(array $data): BcAiAssistantLog
    {
        $entity = $this->bcAiAssistantLogsTable->newEntity($data);
        return $this->bcAiAssistantLogsTable->saveOrFail($entity);
    }

    /**
     * 月毎のサイト全体のトークン制限を確認する
     *
     * @return bool
     */
    public function checkSiteTokensLimit(): bool
    {
        $siteTokensLimit = $this->setting->site_tokens_limit;
        if (empty($siteTokensLimit)) {
            return true;
        }

        $currentMonth = date('Y-m');
        $query = $this->bcAiAssistantLogsTable->find()
            ->where(['created LIKE' => "$currentMonth%"]);

        return $this->getTotalTokens($query) < $siteTokensLimit;
    }

    /**
     * 月毎のユーザー別のトークン制限を確認する
     *
     * @param int $userId
     * @return bool
     */
    public function checkUserTokensLimit(int $userId): bool
    {
        $userTokensLimit = $this->setting->user_tokens_limit;
        if (empty($userTokensLimit)) {
            return true;
        }

        $currentMonth = date('Y-m');
        $query = $this->bcAiAssistantLogsTable->find()
            ->where(['created LIKE' => "$currentMonth%"])
            ->where(['user_id' => $userId]);

        return $this->getTotalTokens($query) < $userTokensLimit;
    }

    /**
     * トークン制限を確認する
     *
     * @param int $userId
     * @return bool
     */
    public function checkTokensLimit(int $userId): bool
    {
        return $this->checkSiteTokensLimit() && $this->checkUserTokensLimit($userId);
    }

    /**
     * クエリーからトークンの合計を算出する
     * 
     * @param SelectQuery $query
     * @return int
     */
    public function getTotalTokens(SelectQuery $query): int
    {
        $totalTokens = $query
            ->select(['sum' => $query->func()->sum('total_tokens')])
            ->all();
        return $totalTokens->first()['sum'] ?? 0;
    }
}
