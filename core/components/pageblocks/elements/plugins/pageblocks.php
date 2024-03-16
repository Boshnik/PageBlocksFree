<?php
/**
 * PageBlocks
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

/** @var PageBlocks $pageblocks */
if ($modx->services instanceof MODX\Revolution\Services\Container) {
    $pageblocks = $modx->services->get('pageblocks');
} else {
    $pageblocks = $modx->getService('pageblocks', 'PageBlocks', MODX_CORE_PATH . 'components/pageblocks/model/');
}

$className = 'Boshnik\PageBlocks\Events\\' . $modx->event->name;
if (class_exists($className)) {
    $handler = new $className($modx, $scriptProperties);
    $handler->run();
}