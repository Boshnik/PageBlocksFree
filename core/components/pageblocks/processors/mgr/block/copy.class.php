<?php

class pbBlockGetProcessor extends modObjectGetProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbBlock::class;
    public $languageTopics = ['pageblocks'];
    public $model_type = 'pbBlock';

    public function cleanup() {

        $array = $this->object->toArray();
        $array['menuindex'] = $this->modx->getCount($this->classKey);
        $array['name'] = $array['name'] . ' ' . $array['menuindex'];

        $newObject = $this->modx->newObject($this->classKey);
        $newObject->fromArray($array, '', false, true);
        if (!$newObject->save()) $this->failure('',$array);

        // Copy fields (tab_id == 0)
        $fields = $this->object->getMany('Fields', ['tab_id' => 0]);
        foreach ($fields as $field) {
            $this->createRow(pbField::class, $field, [
                'model_type' => $this->model_type,
                'model_id' => $newObject->id
            ]);
        };

        // Copy tab fields
        $tabs = $this->object->getMany('Tabs');
        foreach ($tabs as $tab) {
            $tab_id = $this->createRow(pbFieldTab::class, $tab, [
                'model_type' => $this->model_type,
                'model_id' => $newObject->id
            ]);
            if ($tab_id) {
                $this->object->_relatedObjects['Fields'] = [];
                $fields = $this->object->getMany('Fields', ['tab_id' => $tab->id]);
                foreach ($fields as $field) {
                    $this->createRow(pbField::class, $field, [
                        'model_type' => $this->model_type,
                        'model_id' => $newObject->id,
                        'tab_id' => $tab_id,
                    ]);
                };
            }
        }

        return $this->success('',$array);
    }

    public function createRow($className, $row, $properties)
    {
        $newRow = $this->modx->newObject($className);
        $newRow->fromArray($row->toArray(), '', false, true);
        foreach ($properties as $name => $value) {
            $newRow->set($name, $value);
        }

        return $newRow->save() ? $newRow->id : false;
    }

}

return 'pbBlockGetProcessor';