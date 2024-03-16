<?php
/** @var modX $modx */
/** @var array $scriptProperties */
/** @var PageBlocks $pageblocks */

if ($modx->services instanceof MODX\Revolution\Services\Container) {
    $pageblocks = $modx->services->get('pageblocks');
    $pdotools = $modx->services->get('pdotools');
} else {
    $pageblocks = $modx->getService('pageblocks', 'PageBlocks', MODX_CORE_PATH . 'components/pageblocks/model/', $scriptProperties);
    $pdotools = $modx->getService('pdotools', 'pdoTools', MODX_CORE_PATH . 'components/pdotools/model/', $scriptProperties);
}
if (!$pageblocks) {
    return 'Could not load PageBlocks class!';
}

if ($modx->services instanceof MODX\Revolution\Services\Container) {
    $pdotools = $modx->services->get('pdotools');
} else {
    $pdotools = $modx->getService('pdotools', 'pdoTools', MODX_CORE_PATH . 'components/pdotools/model/', $scriptProperties);
}
if (!$pdotools) {
    $pdotools = $modx;
}

$modelType = $modx->getOption('modelType', $scriptProperties, $modx->resource->_class, true);
$classKey = $modx->getOption('classKey', $scriptProperties, 'pbBlockValue', true);
$tpl = $modx->getOption('tpl', $scriptProperties, '');
$sortby = $modx->getOption('sortby', $scriptProperties, 'menuindex');
$sortdir = $modx->getOption('sortdir', $scriptProperties, 'ASC');
$limit = $modx->getOption('limit', $scriptProperties, 0);
$offset = $modx->getOption('offset', $scriptProperties, 0);
$return = $modx->getOption('return', $scriptProperties, 'data');
$fileElements = $modx->getOption('fileElements', $scriptProperties, false);
$id = $modx->getOption('id', $scriptProperties, '', true);
$context_key = $modx->getOption('context_key', $scriptProperties, $modx->resource->context_key, true);
$resource_id = $modx->getOption('resource_id', $scriptProperties, $modx->resource->id, true);
$collection_id = $modx->getOption('collection_id', $scriptProperties, 0, true);
$where = $modx->getOption('where', $scriptProperties, [
    'model_type' => $modelType,
    'model_id' => $resource_id,
    'context_key' => $context_key,
    'published' => 1,
    'deleted' => 0,
], true);

if ($classKey === 'pbTableValue') {
    $where['collection_id'] = $collection_id;
}

if (is_string($where) && ($where[0] === '{' || $where[0] === '[')) {
    $where = json_decode($where, 1);
}

if ($id) {
    $where = [
        'id' => $id,
        'published' => 1,
        'deleted' => 0,
    ];
}

// Build query
$c = $modx->newQuery($classKey);
$c->sortby($sortby, $sortdir);
$c->where($where);
$c->limit($limit);
$items = $modx->getIterator($classKey, $c);

$list = [];
foreach ($items as $idx => $item) {
    $values = array_merge(json_decode($item->values,1), $item->toArray());
    $values['resource_id'] = $item->resource_id;
    $values['pls'] = $values;
    $values['id'] = $item->id;
    $values['idx'] = $idx;

    if ($fileElements) {
        $item->chunk = "@FILE chunks/{$item->chunk}.tpl";
    }

    $list[] = ($return === 'json')
            ? $values
            : $pdotools->getChunk($tpl ?: $item->chunk, $values);
}

// Output
if ($return === 'json') return $list;
$output = implode("\n", $list);
return $output;