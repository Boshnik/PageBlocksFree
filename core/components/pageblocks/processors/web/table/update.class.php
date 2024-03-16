<?php

use Boshnik\PageBlocks\Processors\QueryProcessor;
use Boshnik\PageBlocks\Processors\HelpProcessor;
use Boshnik\PageBlocks\Processors\MediaSourceProcessor;
use Boshnik\PageBlocks\Processors\FileProcessor;

class pbTableValueUpdateProcessor extends modObjectUpdateProcessor
{
    use QueryProcessor;
    use HelpProcessor;
    use MediaSourceProcessor;
    use FileProcessor;

    public $objectType = 'pb_object';
    public $classKey = pbTableValue::class;
    public $languageTopics = ['pageblocks'];
    public $model_type = 'pbTable';


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

        $this->properties['editedon'] = time();
        $this->properties['editedby'] = $this->modx->user->id;

        return parent::beforeSet();
    }


    /**
     * @return mixed
     */
    public function afterSave()
    {
        $this->updateValues($this->object);

        return true;
    }
}

return 'pbTableValueUpdateProcessor';
