<?php

class pbTableValueRemoveProcessor extends modObjectRemoveProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbTableValue::class;
    public $languageTopics = ['pageblocks'];

}

return 'pbTableValueRemoveProcessor';