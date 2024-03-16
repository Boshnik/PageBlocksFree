<?php

class pbTableColumnDisableProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbTableColumn::class;
    public $languageTopics = ['pageblocks'];


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $this->properties = [
            'published' => 0,
        ];

        return true;
    }
}

return 'pbTableColumnDisableProcessor';
