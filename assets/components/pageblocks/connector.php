<?php
/**
 * PageBlocks connector
 *
 * @var modX $modx
 */

require_once dirname(__FILE__, 4) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

/** @var PageBlocks $pageblocks */
if ($modx->services instanceof MODX\Revolution\Services\Container) {
    $pageblocks = $modx->services->get('pageblocks');
} else {
    $pageblocks = $modx->getService('pageblocks', 'PageBlocks', MODX_CORE_PATH . 'components/pageblocks/model/');
}

// Handle request
$modx->request->handleRequest([
    'processors_path' => $pageblocks->config['processorsPath'],
    'location' => ''
]);