<?php

class pbBlockRemoveProcessor extends modObjectRemoveProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbBlock::class;
    public $languageTopics = ['pageblocks'];
    //public $permission = 'remove';

}

return 'pbBlockRemoveProcessor';