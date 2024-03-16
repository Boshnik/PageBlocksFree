<?php

class pbTableGetProcessor extends modObjectGetProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbTable::class;
    public $languageTopics = ['pageblocks:default'];

}

return 'pbTableGetProcessor';