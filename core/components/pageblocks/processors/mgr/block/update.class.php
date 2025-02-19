<?php

class pbBlockUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbBlock::class;
    public $languageTopics = ['pageblocks'];
    public $model_type = 'pbBlock';

    public function beforeSet()
    {
        $id = (int) $this->properties['id'];
        if (empty($id)) {
            return $this->modx->lexicon('pb_object_err_ns');
        }

        $name = trim($this->properties['name']);
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('pb_object_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name, 'id:!=' => $id])) {
            $this->modx->error->addField('name', $this->modx->lexicon('pb_object_err_ae'));
        }

        $chunk = trim($this->properties['chunk']);
        if (empty($chunk)) {
            $this->modx->error->addField('chunk', $this->modx->lexicon('pb_chunk_err_name'));
        }

        if (!empty($this->properties['ab_templates'])) {
            $this->properties['ab_templates'] = implode('||', $this->properties['ab_templates']);
        }

        return parent::beforeSet();
    }

    public function afterSave()
    {
        $blocks = $this->object->getMany('Values') ?? [];
        foreach ($blocks as $block) {
            $block->set('block_name', $this->object->name);
            $block->set('chunk', $this->object->chunk);
            $block->save();
        }
    }
}

return 'pbBlockUpdateProcessor';