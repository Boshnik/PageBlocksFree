<?php

class pbFieldTabUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbFieldTab::class;
    public $languageTopics = ['pageblocks'];
    //public $permission = 'save';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $id = (int) $this->properties['id'];
        if (empty($id)) {
            return $this->modx->lexicon('pb_object_err_ns');
        }

        $name = trim($this->properties['name']);
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('pb_object_err_name'));
        } elseif ($this->modx->getCount($this->classKey, [
            'id:!=' => $id,
            'name' => $name,
            'model_type' => (int) $this->properties['model_type'],
            'model_id' => (int) $this->properties['model_id'],
        ])) {
            $this->modx->error->addField('name', $this->modx->lexicon('pb_object_err_ae'));
        }

        return parent::beforeSet();
    }
}

return 'pbFieldTabUpdateProcessor';