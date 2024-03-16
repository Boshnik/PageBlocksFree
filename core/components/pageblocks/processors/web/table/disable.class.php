<?php

use Boshnik\PageBlocks\Processors\QueryProcessor;

class pbTableValueDisableProcessor extends modObjectUpdateProcessor
{
    use QueryProcessor;

    public $objectType = 'pb_object';
    public $classKey = pbTableValue::class;
    public $languageTopics = ['pageblocks'];


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $this->properties = [
            'published' => 0,
            'editedon' => time(),
            'editedby' => $this->modx->user->id,
        ];

        return true;
    }
}

return 'pbTableValueDisableProcessor';
