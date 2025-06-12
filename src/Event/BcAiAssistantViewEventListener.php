<?php

namespace BcAiAssistant\Event;

use BaserCore\Event\BcViewEventListener;
use BaserCore\Utility\BcUtil;
use Cake\Event\EventInterface;

/**
 * BcAiAssistantViewEventListener
 */
class BcAiAssistantViewEventListener extends BcViewEventListener
{
    public $events = ['beforeLayout'];

    /**
     * beforeLayout
     *
     * @param EventInterface $event
     * @return void
     */
    public function beforeLayout(EventInterface $event)
    {
        if (!BcUtil::isAdminSystem()) {
            return;
        }

        $view = $event->getSubject();

        $request = $view->getRequest();
        if (
            !($request->getParam('plugin') === 'BcBlog' && $request->getParam('controller') === 'BlogPosts' && in_array($request->getParam('action'), ['add', 'edit'])) &&
            !($request->getParam('plugin') === 'BaserCore' && $request->getParam('controller') === 'Pages' && in_array($request->getParam('action'), ['add', 'edit']))
        ) {
            return;
        }

        $view->BcBaser->css('BcAiAssistant.admin/bc_ai_assistant_admin', false);

        $contentType = null;
        if ($request->getParam('plugin') === 'BcBlog' && $request->getParam('controller') === 'BlogPosts') {
            $contentType = 'BlogContent';
        } elseif ($request->getParam('plugin') === 'BaserCore' && $request->getParam('controller') === 'Pages') {
            $contentType = 'Page';
        }
        $script = <<<"JS"
        const aiAssistantContentType = "{$contentType}";
        JS;
        $view->BcBaser->setScript($script, ['block' => true]);

        if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
            $script = <<<'JS'
            import RefreshRuntime from "http://localhost:5173/@react-refresh"
            RefreshRuntime.injectIntoGlobalHook(window);
            window.$RefreshReg$ = () => {};
            window.$RefreshSig$ = () => (type) => type;
            window.__vite_plugin_react_preamble_installed__ = true;
            JS;
            $view->BcBaser->setScript($script, ['block' => true, 'type' => "module"]);
            $view->BcBaser->js('http://localhost:5173/@vite/client', false, ['type' => "module"]);
            $view->BcBaser->js('http://localhost:5173/index.tsx', false, ['type' => "module"]);
        } else {
            $view->BcBaser->js('BcAiAssistant.admin/app', false);
        }
    }
}
