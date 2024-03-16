<?php

class pbFieldRemoveProcessor extends modObjectRemoveProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbField::class;
    public $languageTopics = ['pageblocks'];
    //public $permission = 'remove';


    /**
     * @return true
     */
    public function afterRemove()
    {
        $query = $this->modx->newQuery($this->classKey);
        $query->where([
            'model_type' => $this->object->get('model_type'),
            'model_id' => $this->object->get('model_id'),
        ]);
        $query->sortby('menuindex', 'asc');
        $rows = $this->modx->getCollection($this->classKey, $query);
        $menuindex = 0;
        foreach ($rows as $row) {
            $row->set('menuindex', $menuindex++);
            $row->save();
        }

        return true;
    }

}

return 'pbFieldRemoveProcessor';