<?php

class pbFieldTabRemoveProcessor extends modObjectRemoveProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbFieldTab::class;
    public $languageTopics = ['pageblocks'];

}

return 'pbFieldTabRemoveProcessor';