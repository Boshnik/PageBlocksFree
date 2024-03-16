<?php

class pbFieldDisableProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbField::class;
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

return 'pbFieldDisableProcessor';
