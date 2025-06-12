<?php

$viewFilesPath = str_replace(ROOT, '', WWW_ROOT) . 'files';
return [
    'type' => 'Plugin',
    'title' => 'baserCMS AI Assistant',
    'description' => 'baserCMSのためのAIアシスタントプラグインです。',
    'author' => 'Koki Uchino',
    'url' => '',
    'adminLink' => ['plugin' => 'BcAiAssistant', 'controller' => 'BcAiAssistantSettings', 'action' => 'index'],
];
