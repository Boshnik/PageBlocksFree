<?php

class pbBlockGetProcessor extends modObjectGetProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbBlock::class;
    public $languageTopics = ['pageblocks:default'];
    //public $permission = 'view';

}

return 'pbBlockGetProcessor';