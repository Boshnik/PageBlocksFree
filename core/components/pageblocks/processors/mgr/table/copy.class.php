<?php

class pbTableCopyProcessor extends modObjectGetProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbTable::class;
    public $languageTopics = ['pageblocks:default'];

    public $composites = [
        'Tabs' => pbFieldTab::class,
        'Fields' => pbField::class,
        'Columns' => pbTableColumn::class,
    ];

    public function cleanup() {

        $array = $this->object->toArray();
        $array['menuindex'] = $this->modx->getCount($this->classKey);
        $array['name'] = $array['name'] . ' ' . $array['menuindex'];

        $newObject = $this->modx->newObject($this->classKey);
        $newObject->fromArray($array, '', false, true);
        if (!$newObject->save()) $this->failure('',$array);

        foreach ($this->composites as $alias => $className) {
            $rows = $this->object->getMany($alias);
            foreach ($rows as $row) {
                $newRow = $this->modx->newObject($className);
                $newRow->fromArray($row->toArray(), '', false, true);
                $newRow->set('model_id', $newObject->id);
                if ($newRow->save()) {
                    if ($alias === 'Fields') {
                        $this->updateFieldTab($row, $newRow);
                    }
                    if ($alias === 'Columns') {
                        $this->updateColumns($row, $newRow);
                    }
                }
            };
        }

        return $this->success('',$array);
    }

    public function updateFieldTab($field, $newField)
    {
        if ($field->tab_id) {
            $newTab = $this->modx->getObject($this->composites['Tabs'], [
                'model_id' => $newField->model_id,
                'name' => $field->getTabName()
            ]);

            if ($newTab) {
                $newField->set('tab_id', $newTab->id);
                $newField->save();
            }
        }
    }

    public function updateColumns($column, $newColumn)
    {
        $newField = $this->modx->getObject($this->composites['Fields'], [
            'model_id' => $newColumn->model_id,
            'name' => $column->getOne('Field')->name
        ]);

        if ($newField) {
            $newColumn->set('field_id', $newField->id);
            $newColumn->save();
        }
    }

}

return 'pbTableCopyProcessor';