<?php

use Boshnik\PageBlocks\Processors\QueryProcessor;
use Boshnik\PageBlocks\Processors\HelpProcessor;
use Boshnik\PageBlocks\Processors\MediaSourceProcessor;
use Boshnik\PageBlocks\Processors\FileProcessor;

class pbBlockValueCreateProcessor extends modObjectCreateProcessor
{
    use QueryProcessor;
    use HelpProcessor;
    use MediaSourceProcessor;
    use FileProcessor;

    public $objectType = 'pb_object';
    public $classKey = pbBlockValue::class;
    public $languageTopics = ['pageblocks'];
    public $model_type = 'pbBlock';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $fields = $this->modx->getCollection(pbField::class, [
            'model_type' => $this->model_type,
            'model_id' => $this->properties['constructor_id'],
            'published' => 1
        ]);

        $values = $this->filterValues($fields, $this->properties);
        $values = $this->prepareValues($fields, $values);
        $this->properties['values'] = json_encode($values, JSON_UNESCAPED_UNICODE);

        $this->properties['createdon'] = time();
        $this->properties['createdby'] = $this->modx->user->id;
        $this->properties['menuindex'] = $this->modx->getCount($this->classKey, [
            'model_type' => $this->properties['model_type'],
            'model_id' => $this->properties['model_id'] ?? 0,
            'context_key' => $this->properties['context_key'],
        ]);

        $constructor = $this->modx->getObject(pbBlock::class, $this->properties['constructor_id']);
        $this->properties['chunk'] = $constructor->chunk;

        return parent::beforeSet();
    }


    public function afterSave()
    {
        $this->changeParent($this->object);
        $this->updateFiles($this->object);
        $this->updateValues($this->object);

        return true;
    }

}

return 'pbBlockValueCreateProcessor';