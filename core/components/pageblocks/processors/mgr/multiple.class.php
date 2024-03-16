<?php

class PageBlocksMgrMultipleProcessor extends modProcessor
{

    /**
     * @return array|string
     */
    public function process()
    {
        if (!$method = $this->getProperty('method', false)) {
            return $this->failure();
        }
        $ids = json_decode($this->getProperty('ids'), true);
        if (empty($ids)) {
            return $this->success();
        }

        /** @var PageBlocks $pageblocks */
        if ($this->modx->services instanceof MODX\Revolution\Services\Container) {
            $pageblocks = $this->modx->services->get('pageblocks');
        } else {
            $pageblocks = $this->modx->getService('pageblocks', 'PageBlocks', MODX_CORE_PATH . 'components/pageblocks/model/');
        }

        foreach ($ids as $id) {
            /** @var modProcessorResponse $response */
            $response = $pageblocks->runProcessor('mgr/' . $method, ['id' => $id]);
            if ($response->isError()) {
                return $response->getResponse();
            }
        }

        return $this->success();
    }

}

return 'PageBlocksMgrMultipleProcessor';