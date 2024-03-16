<?php

class pbFieldTabGetProcessor extends modObjectGetProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbFieldTab::class;
    public $languageTopics = ['pageblocks'];

}

return 'pbFieldTabGetProcessor';