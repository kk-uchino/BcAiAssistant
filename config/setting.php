<?php

return [
    'BcApp' => [
        'adminNavigation' => [
            'Contents' => [
                'BcAiAssistant' => [
                    'title' => 'AIアシスタント',
                    'icon' => 'bc-ai-assistant',
                    'menus' => [
                        [
                            'title' => '生成ログ一覧',
                            'url' => ['prefix' => 'Admin', 'plugin' => 'BcAiAssistant', 'controller' => 'BcAiAssistantLogs', 'action' => 'index'],
                        ],
                        [
                            'title' => '設定',
                            'url' => ['prefix' => 'Admin', 'plugin' => 'BcAiAssistant', 'controller' => 'BcAiAssistantSettings', 'action' => 'index'],
                        ],
                    ]
                ]
            ]
        ]
    ],
];
