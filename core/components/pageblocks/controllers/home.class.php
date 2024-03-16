<?php

use Boshnik\PageBlocks\Processors\HelpProcessor;

/**
 * The home manager controller for PageBlocks.
 *
 */
class PageBlocksHomeManagerController extends modExtraManagerController
{
    use HelpProcessor;

    /** @var PageBlocks $pageblocks */
    public $pageblocks;

    public function initialize()
    {
        if ($this->modx->services instanceof MODX\Revolution\Services\Container) {
            $this->pageblocks = $this->modx->services->get('pageblocks');
        } else {
            $this->pageblocks = $this->modx->getService('pageblocks', 'PageBlocks', MODX_CORE_PATH . 'components/pageblocks/model/');
        }
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['pageblocks:default', 'core:tv_input_types', 'core:tv_widget'];
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('pageblocks');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $cssUrl = $this->pageblocks->config['cssUrl'] . 'mgr/';
        $jsUrl = $this->pageblocks->config['jsUrl'] . 'mgr/';

        $this->addCss($cssUrl . 'main.css');

        $this->addJavascript($jsUrl . 'pageblocks.js');
        $this->addJavascript($jsUrl . 'misc/utils.js');
        $this->addJavascript($jsUrl . 'misc/combo.js');
        $this->addJavascript($jsUrl . 'misc/default.grid.js');
        $this->addJavascript($jsUrl . 'misc/default.window.js');

        // Block
        $this->addJavascript($jsUrl . 'widgets/block/grid.js');
        $this->addJavascript($jsUrl . 'widgets/block/windows.js');

        // Table
        $this->addJavascript($jsUrl . 'widgets/table/grid.js');
        $this->addJavascript($jsUrl . 'widgets/table/windows.js');

        // Column
        $this->addJavascript($jsUrl . 'widgets/column/grid.js');
        $this->addJavascript($jsUrl . 'widgets/column/windows.js');

        // Field
        $this->addJavascript($jsUrl . 'widgets/field/grid.js');
        $this->addJavascript($jsUrl . 'widgets/field/windows.js');

        // Tab
        $this->addJavascript($jsUrl . 'widgets/tab/grid.js');
        $this->addJavascript($jsUrl . 'widgets/tab/windows.js');

        $this->addJavascript($jsUrl . 'panel/home.js');
        $this->addJavascript($jsUrl . 'page/home.js');

        $this->addHtml('<script>
            Ext.onReady(() => {
                PageBlocks.config = ' . json_encode($this->pageblocks->config) . ';
                PageBlocks.grid.create = 1;
                PageBlocks.window.save = 1;
                MODx.load({ xtype: "pb-page-home"});
            });
        </script>');

        $this->loadRichTextEditor();
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="pb-panel-home-div"></div>';
    }
}