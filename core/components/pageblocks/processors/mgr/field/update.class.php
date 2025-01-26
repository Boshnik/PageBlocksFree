<?php

use Boshnik\PageBlocks\Processors\QueryProcessor;
use Boshnik\PageBlocks\Processors\HelpProcessor;

class pbFieldUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbField::class;
    public $languageTopics = ['pageblocks'];

    use QueryProcessor;
    use HelpProcessor;

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
            'model_type' => $this->properties['model_type'],
            'model_id' => (int) $this->properties['model_id'],
        ])) {
            $this->modx->error->addField('name', $this->modx->lexicon('pb_object_err_ae'));
        }

        if (!preg_match("/^[\w\s.,-]*$/", $name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('pb_object_err_name_cyrillic'));
        }

        $this->properties['properties'] = json_encode($this->getFieldProps(),1);

        return parent::beforeSet();
    }
}

return 'pbFieldUpdateProcessor';