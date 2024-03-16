<?php

namespace Boshnik\PageBlocks\Events;

/**
 * class OnSiteSettingsRender
 */
class OnSiteSettingsRender extends Event
{
    public function run()
    {
        $config = $this->pageblocks->config;
        $jsUrl = $config['jsUrl'];

        $this->modx->controller->addJavascript($jsUrl . 'mgr/misc/modx.combo.js');
    }
}