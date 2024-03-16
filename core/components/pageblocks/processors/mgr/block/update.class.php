<?php

class pbBlockUpdateProcessor extends modObjectUpdateProcessor
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
        $this->properties['old_chunk'] = $this->object->chunk;

        if (!empty($this->properties['ab_templates'])) {
            $this->properties['ab_templates'] = implode('||', $this->properties['ab_templates']);
        }

        return parent::beforeSet();
    }


    /**
     * @return bool
     */
    public function afterSave()
    {
        if ($this->properties['old_chunk'] !== $this->object->chunk) {
            $blocks = $this->modx->getCollection(pbBlockValue::class, [
                'chunk' => $this->properties['old_chunk'],
                'model_type' => $this->model_type,
                'model_id' => $this->object->id,
            ]);
            foreach ($blocks as $block) {
                $block->set('chunk', $this->object->chunk);
                $block->save();
            }
        }
    }
}

return 'pbBlockUpdateProcessor';