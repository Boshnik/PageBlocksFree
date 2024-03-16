<?php

class pbTableColumnGetProcessor extends modObjectGetProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbTableColumn::class;
    public $languageTopics = ['pageblocks:default'];

    /**
     * Return the response
     * @return array
     */
    public function cleanup()
    {
        $array = $this->object->toArray();
        $array['caption'] = $this->object->getOne('Field')->caption;

        return $this->success('',$array);
    }

}

return 'pbTableColumnGetProcessor';