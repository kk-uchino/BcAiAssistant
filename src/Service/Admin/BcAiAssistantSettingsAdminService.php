<?php

namespace BcAiAssistant\Service\Admin;

use BcAiAssistant\Model\Entity\BcAiAssistantSetting;
use BcAiAssistant\Model\Table\BcAiAssistantSettingsTable;
use Cake\ORM\TableRegistry;

/**
 * BcAiAssistantSettingsAdminService
 *
 * @property BcAiAssistantSettingsTable $bcAiAssistantSettingsTable
 * @property BcAiAssistantSetting|null $setting
 */
class BcAiAssistantSettingsAdminService
{
    public function __construct()
    {
        $this->bcAiAssistantSettingsTable = TableRegistry::getTableLocator()->get('BcAiAssistant.BcAiAssistantSettings');
        $this->setting = null;
    }

    /**
     * 設定を取得する
     *
     * @return BcAiAssistantSetting
     */
    public function getSetting(): BcAiAssistantSetting
    {
        if (!$this->setting) {
            $this->setting = $this->bcAiAssistantSettingsTable->newEntity($this->bcAiAssistantSettingsTable->getKeyValue(), ['validate' => 'keyValue']);
        }
        return $this->setting;
    }

    /**
     * 設定を更新する
     *
     * @param array $data
     * @return BcAiAssistantSetting|bool
     */
    public function updateSetting(array $data): BcAiAssistantSetting|bool
    {
        $setting = $this->bcAiAssistantSettingsTable->newEntity($data, ['validate' => 'keyValue']);
        if ($setting->hasErrors()) {
            return $setting;
        }

        if ($this->bcAiAssistantSettingsTable->saveKeyValue($setting->toArray())) {
            $this->setting = null;
            return $this->getSetting();
        }

        return false;
    }
}
