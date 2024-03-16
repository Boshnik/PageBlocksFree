<?php

namespace Boshnik\PageBlocks\Events;

use Boshnik\PageBlocks\Processors\QueryProcessor;
use Boshnik\PageBlocks\Processors\HelpProcessor;

/**
 * class OnDocFormPrerender
 */
class OnDocFormPrerender extends Event
{
    use QueryProcessor;
    use HelpProcessor;

    public function run()
    {
        /** @var \modResource $resource */
        $resource = $this->scriptProperties['resource'];
        if (!$resource) {
            return true;
        }

        $config = $this->pageblocks->config;
        $cssUrl = $config['cssUrl'];
        $jsUrl = $config['jsUrl'];

        $this->modx->controller->addCss($cssUrl . 'mgr/main.css');
        $this->modx->controller->addCss($cssUrl . 'mgr/resource.css');

        $this->modx->controller->addJavascript($jsUrl . 'mgr/pageblocks.js');
        $this->modx->controller->addJavascript($jsUrl . 'mgr/misc/utils.js');
        $this->modx->controller->addJavascript($jsUrl . 'mgr/misc/combo.js');
        $this->modx->controller->addJavascript($jsUrl . 'mgr/misc/default.grid.js');
        $this->modx->controller->addJavascript($jsUrl . 'mgr/misc/default.window.js');

        // ColorPicker
        $colorpicker = '/assets/components/colorpicker/js/mgr/colorpicker.min.js';
        if (file_exists(MODX_BASE_PATH . $colorpicker)) {
            $this->modx->controller->addJavascript($colorpicker);
        }

        // Block value
        $this->modx->controller->addJavascript($jsUrl . 'web/block/grid.js');
        $this->modx->controller->addJavascript($jsUrl . 'web/block/windows.js');

        // Table value
        $this->modx->controller->addJavascript($jsUrl . 'web/table/grid.js');
        $this->modx->controller->addJavascript($jsUrl . 'web/table/windows.js');

        // File panel
        $this->modx->controller->addJavascript($jsUrl . 'web/panel/file.js');

        // Image panel
        $this->modx->controller->addJavascript($jsUrl . 'web/panel/image.js');

        // Video panel
        $this->modx->controller->addJavascript($jsUrl . 'web/panel/video.js');
        $this->modx->controller->addJavascript($jsUrl . 'web/jsVideoUrlParser.min.js');

        // Button
        $this->modx->controller->addJavascript($jsUrl . 'web/panel/button.js');

        // Windows
        $this->modx->controller->addJavascript($jsUrl . 'web/windows.js');

        // inject pageblocks into resource
        $this->modx->controller->addJavascript($jsUrl . 'pageblocks.js');
        $config['media_source'] = $this->getMediaSources();

        $this->modx->controller->addHtml('<script>
            PageBlocks.config = ' . json_encode($config) . ';
            PageBlocks.resource = ' . json_encode($resource->toArray()) . ';
            PageBlocks.grid.create = 1;
            PageBlocks.window.save = 1;
        </script>');

        $this->loadRichTextEditor();
    }
}