<?php
/** @var MODX\Revolution\modX $modx */

require_once MODX_CORE_PATH . 'components/pageblocks/vendor/autoload.php';

$modx->services['pageblocks'] = $modx->services->factory(function($c) use ($modx) {
    return new Boshnik\PageBlocks\PageBlocks($modx);
});