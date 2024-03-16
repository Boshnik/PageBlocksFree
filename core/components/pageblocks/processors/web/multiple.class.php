<?php

use Boshnik\PageBlocks\Processors\QueryProcessor;

class PageBlocksWebMultipleProcessor extends modProcessor
{

    use QueryProcessor;

    /**
     * @return array|string
     */
    public function process()
    {
        if (isset($this->properties['ids'])) {
            $ids = json_decode($this->properties['ids'], 1);
        }

        /** @var PageBlocks $pageblocks */
        if ($this->modx->services instanceof MODX\Revolution\Services\Container) {
            $pageblocks = $this->modx->services->get('pageblocks');
        } else {
            $pageblocks = $this->modx->getService('pageblocks', 'PageBlocks', MODX_CORE_PATH . 'components/pageblocks/model/');
        }

        // resource block copying
        if (isset($this->properties['resource_block_copying'])) {
            $resource_id = $this->properties['resource_block_copying'];
            $this->properties['method'] = $this->properties['method_path'];
            $className = $this->properties['method_path'] === 'block/copy' ? pbBlockValue::class : pbTableValue::class;
            $ids = $this->getTableIds($className, [
                'model_type' => $this->properties['model_type'],
                'model_id' => (int) $resource_id,
                'context_key' => $this->properties['context_from'] ?? 'web',
                'deleted' => 0,
            ]);
        }

        if (empty($ids)) {
            return $this->success();
        }

        if (!isset($this->properties['method'])) {
            return $this->failure();
        }

        foreach ($ids as $id) {
            /** @var modProcessorResponse $response */
            $response = $pageblocks->runProcessor('web/' . $this->properties['method'], array_merge(
                ['id' => $id],
                $this->properties
            ));
            if ($response->isError()) {
                return $response->getResponse();
            }
        }

        return $this->success();
    }

}

return 'PageBlocksWebMultipleProcessor';