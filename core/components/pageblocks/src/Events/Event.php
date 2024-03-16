<?php

namespace Boshnik\PageBlocks\Events;

abstract class Event
{

    /** @var modX $modx */
    protected $modx;

    /** @var PageBlocks $pageblocks */
    protected $pageblocks;

    /** @var array $scriptProperties */
    protected $scriptProperties;

    public $modxversion;

    public function __construct($modx, &$scriptProperties)
    {
        $this->modx = $modx;
        $this->scriptProperties =& $scriptProperties;

        if ($this->modx->services instanceof MODX\Revolution\Services\Container) {
            $this->pageblocks = $this->modx->services->get('pageblocks');
        } else {
            $this->pageblocks = $this->modx->getService('pageblocks', 'PageBlocks', MODX_CORE_PATH . 'components/pageblocks/model/');
        }
        $this->modxversion = $this->pageblocks->config['modxversion'];
    }

    abstract public function run();
}