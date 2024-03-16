<?php

class pbTableCopyProcessor extends modObjectGetProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbTable::class;
    public $languageTopics = ['pageblocks:default'];
    //public $permission = 'view';


    public function cleanup() {

        $array = $this->object->toArray();
        $array['menuindex'] = $this->modx->getCount($this->classKey);
        $array['name'] = $array['name'] . ' ' . $array['menuindex'];

        $newObject = $this->modx->newObject($this->classKey);
        $newObject->fromArray($array, '', false, true);
        if (!$newObject->save()) $this->failure('',$array);

        $tables = [
            'Fields' => pbField::class,
            'Columns' => pbTableColumn::class,
        ];

        foreach ($tables as $alias => $className) {
            $rows = $this->object->getMany($alias);
            foreach ($rows as $row) {
                $newRow = $this->modx->newObject($className);
                $newRow->fromArray($row->toArray(), '', false, true);
                $newRow->set('model_id', $newObject->id);
                $newRow->save();
            };
        }

        return $this->success('',$array);
    }

}

return 'pbTableCopyProcessor';