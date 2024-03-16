<?php

class pbTableColumnRemoveProcessor extends modObjectRemoveProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbTableColumn::class;
    public $languageTopics = ['pageblocks'];

}

return 'pbTableColumnRemoveProcessor';