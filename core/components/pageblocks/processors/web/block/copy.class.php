<?php

use \Boshnik\PageBlocks\Processors\QueryProcessor;
use \Boshnik\PageBlocks\Processors\CopyProcessor;

class pbBlockValueCopyProcessor extends modObjectGetProcessor
{
    use QueryProcessor;
    use CopyProcessor;

    public $objectType = 'pb_object';
    public $classKey = pbBlockValue::class;
    public $languageTopics = ['pageblocks:default'];

    public function beforeOutput()
    {
        $properties = [
            'model_type' => $this->properties['model_type'] ?? $this->object->model_type,
            'model_id' => $this->properties['model_id'] ?? $this->object->model_id,
            'context_key' => $this->properties['context_key'] ?? $this->object->context_key,
            'deleted' => 0,
        ];

        if (isset($this->properties['context_to'])) {
            $properties['context_key'] = $this->properties['context_to'];
        }

        $this->properties = $properties;
    }

    public function cleanup()
    {

        if (!$this->object) {
            return $this->failure($this->modx->lexicon($this->objectType . '_err_nfs'));
        }

        $this->copyObject($this->object, $this->properties);

        return $this->success('', $this->object->toArray());
    }

}

return 'pbBlockValueCopyProcessor';