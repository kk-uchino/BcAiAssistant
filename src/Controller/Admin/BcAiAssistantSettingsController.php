<?php

namespace BcAiAssistant\Controller\Admin;

use BaserCore\Controller\Admin\BcAdminAppController;
use BcAiAssistant\Service\Admin\BcAiAssistantSettingsAdminService;

/**
 * BcAiAssistantSettingsController
 * 
 * @property BcAiAssistantSettingsAdminService $bcAiAssistantSettingsAdminService
 */
class BcAiAssistantSettingsController extends BcAdminAppController
{
    /**
     * initialize
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->bcAiAssistantSettingsAdminService = new BcAiAssistantSettingsAdminService();
    }

    /**
     * 設定
     */
    public function index()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->bcAiAssistantSettingsAdminService->updateSetting($this->getRequest()->getData());
            if ($setting && !$setting->getErrors()) {
                $this->BcMessage->setInfo('設定を保存しました。');
                return $this->redirect(['action' => 'index']);
            }
            $this->BcMessage->setError(__d('baser_core', '入力エラーです。内容を修正してください。'));
        } else {
            $setting = $this->bcAiAssistantSettingsAdminService->getSetting();
        }

        $this->set('setting', $setting);
    }
}
