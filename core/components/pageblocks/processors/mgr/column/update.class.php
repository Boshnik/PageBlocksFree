<?php

class pbTableColumnUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbTableColumn::class;
    public $languageTopics = ['pageblocks'];
    public $model_type = 'pbTable';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $id = (int) $this->properties['id'];
        $model_id = (int) $this->properties['model_id'];
        $field_id = (int) ($this->properties['field_id']);

        if (empty($field_id)) {
            $this->modx->error->addField('field_id', $this->modx->lexicon('pb_object_err_field'));
        } elseif ($this->modx->getCount($this->classKey, [
            'id:!=' => $id,
            'model_type' => $this->model_type,
            'model_id' => $model_id,
            'field_id' => $field_id,
        ])) {
            $this->modx->error->addField('field_id', $this->modx->lexicon('pb_object_err_ae'));
        }

        return true;
    }
}

return 'pbTableColumnUpdateProcessor';
