<?php

namespace BcAiAssistant\Controller\Admin;

use BaserCore\Controller\Admin\BcAdminAppController;
use BaserCore\Utility\BcSiteConfig;
use BcAiAssistant\Service\Admin\BcAiAssistantLogsAdminService;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;

/**
 * BcAiAssistantLogsController
 * 
 * @property BcAiAssistantLogsAdminService $bcAiAssistantLogsAdminService
 */
class BcAiAssistantLogsController extends BcAdminAppController
{
    /**
     * initialize
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->bcAiAssistantLogsAdminService = new BcAiAssistantLogsAdminService();
    }

    /**
     * 生成ログ一覧
     */
    public function index()
    {
        $this->setViewConditions('BlogPost', [
            'default' => [
                'query' => [
                    'limit' => BcSiteConfig::get('admin_list_num'),
                    'sort' => 'id',
                    'direction' => 'desc',
                ]
            ]
        ]);

        $query = $this->bcAiAssistantLogsAdminService->getLogsQuery($this->getRequest()->getQueryParams());
        try {
            $entities = $this->paginate($query);
        } catch (NotFoundException $e) {
            return $this->redirect(['action' => 'index']);
        }

        $totalTokens = $this->bcAiAssistantLogsAdminService->getTotalTokens($query);

        $usersTable = TableRegistry::getTableLocator()->get('BaserCore.Users');
        $userList = $usersTable->getUserList();

        $this->set('logs', $entities);
        $this->set('totalTokens', $totalTokens);
        $this->set('userList', $userList);
        $this->request = $this->request->withParsedBody($this->request->getQuery());
    }
}
