<?php

use Boshnik\PageBlocks\Processors\QueryProcessor;
use Boshnik\PageBlocks\Processors\CopyProcessor;

class pbTableValueCopyProcessor extends modObjectGetProcessor
{
    use QueryProcessor;
    use CopyProcessor;

    public $objectType = 'pb_object';
    public $classKey = pbTableValue::class;
    public $languageTopics = ['pageblocks'];

    public function beforeOutput()
    {
        $this->properties = [
            'model_type' => $this->properties['model_type'] ?? $this->object->model_type,
            'model_id' => $this->properties['model_id'] ?? $this->object->model_id,
            'context_key' => $this->properties['context_key'] ?? $this->object->context_key,
            'field_id' => $this->object->field_id,
        ];
    }


    /**
     * @return mixed
     */
    public function cleanup()
    {
        $this->copyObject($this->object, $this->properties);

        return $this->success('', $this->object->toArray());
    }

}

return 'pbTableValueCopyProcessor';