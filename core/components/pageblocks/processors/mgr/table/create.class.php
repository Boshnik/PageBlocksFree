<?php

class pbTableCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbTable::class;
    public $languageTopics = ['pageblocks'];
    public $model_type = 'pbTable';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('pb_object_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name])) {
            $this->modx->error->addField('name', $this->modx->lexicon('pb_object_err_ae'));
        }

        $this->properties['menuindex'] = $this->modx->getCount($this->classKey);

        return parent::beforeSet();
    }


    /**
     * @return bool
     */
    public function afterSave()
    {
        $tables = [pbField::class, pbFieldTab::class, pbTableColumn::class];
        foreach ($tables as $className) {
            if ($rows = $this->modx->getCollection($className, [
                'model_type' => $this->model_type,
                'model_id' => 0
            ])) {
                foreach ($rows as $row) {
                    $row->set('model_id', $this->object->id);
                    $row->save();
                }
            }
        }

        return true;
    }

}

return 'pbTableCreateProcessor';