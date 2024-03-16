<?php

class pbTableRemoveProcessor extends modObjectRemoveProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbTable::class;
    public $languageTopics = ['pageblocks'];
    //public $permission = 'remove';

}

return 'pbTableRemoveProcessor';