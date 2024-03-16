<?php

class pbBlockCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbBlock::class;
    public $languageTopics = ['pageblocks'];
    public $model_type = 'pbBlock';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->properties['name']);
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon($this->objectType.'_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name])) {
            $this->modx->error->addField('name', $this->modx->lexicon($this->objectType.'_err_ae'));
        }

        $chunk = trim($this->properties['chunk']);
        if (empty($chunk)) {
            $this->modx->error->addField('chunk', $this->modx->lexicon('pb_chunk_err_name'));
        }

        if (isset($this->properties['ab_templates'])) {
            $this->properties['ab_templates'] = implode('||', $this->properties['ab_templates']);
        }

        $this->properties['menuindex'] = $this->modx->getCount($this->classKey);

        return true;
    }

    /**
     * @return bool
     */
    public function afterSave()
    {
        $tables = [pbField::class, pbFieldTab::class];
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

return 'pbBlockCreateProcessor';