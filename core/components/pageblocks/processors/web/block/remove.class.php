<?php

class pbBlockValueRemoveProcessor extends modObjectRemoveProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbBlockValue::class;
    public $languageTopics = ['pageblocks'];

}

return 'pbBlockValueRemoveProcessor';