<?php

class pbFieldTabCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbFieldTab::class;
    public $languageTopics = ['pageblocks'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('pb_object_err_name'));
        } elseif ($this->modx->getCount($this->classKey, [
            'name' => $name,
            'model_type' => $this->properties['model_type'],
            'model_id' => $this->properties['model_id'],
        ])) {
            $this->modx->error->addField('name', $this->modx->lexicon('pb_object_err_ae'));
        }

        $this->properties['menuindex'] = $this->modx->getCount($this->classKey, [
            'model_type' => $this->properties['model_type'],
            'model_id' => $this->properties['model_id'],
        ]);

        return parent::beforeSet();
    }

}

return 'pbFieldTabCreateProcessor';