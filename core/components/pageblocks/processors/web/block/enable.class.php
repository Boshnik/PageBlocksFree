<?php

use Boshnik\PageBlocks\Processors\QueryProcessor;

class pbBlockValueEnableProcessor extends modObjectUpdateProcessor
{
    use QueryProcessor;

    public $objectType = 'pb_object';
    public $classKey = pbBlockValue::class;
    public $languageTopics = ['pageblocks'];

    /**
     * @return bool
     */
    public function beforeSet()
    {
        $this->properties = [
            'published' => 1,
            'publishedby' => $this->modx->user->id,
            'editedon' => time(),
            'editedby' => $this->modx->user->id,
        ];

        return true;
    }

}

return 'pbBlockValueEnableProcessor';
