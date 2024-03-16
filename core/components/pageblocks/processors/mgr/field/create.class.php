<?php

use Boshnik\PageBlocks\Processors\QueryProcessor;
use Boshnik\PageBlocks\Processors\HelpProcessor;

class pbFieldCreateProcessor extends modObjectCreateProcessor
{
    use QueryProcessor;
    use HelpProcessor;

    public $objectType = 'pb_object';
    public $classKey = pbField::class;
    public $languageTopics = ['pageblocks'];

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

        if (!preg_match("/^[\w\d\s.,-]*$/", $name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('pb_object_err_name_cyrillic'));
        }

        $this->properties['menuindex'] = $this->modx->getCount($this->classKey, [
            'model_type' => $this->properties['model_type'],
            'model_id' => $this->properties['model_id'] ?? 0,
        ]);

        $this->properties['properties'] = json_encode($this->getFieldProps(),1);

        return parent::beforeSet();
    }

}

return 'pbFieldCreateProcessor';