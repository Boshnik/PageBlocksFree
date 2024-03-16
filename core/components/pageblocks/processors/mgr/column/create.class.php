<?php

class pbTableColumnCreateProcessor extends modObjectCreateProcessor
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
        $field_id = (int) $this->properties['field_id'];
        $model_id = (int) $this->properties['model_id'];
        if (empty($field_id)) {
            $this->modx->error->addField('field_id', $this->modx->lexicon('pb_object_err_name'));
        } elseif ($this->modx->getCount($this->classKey, [
                'field_id' => $field_id,
                'model_type' => $this->model_type,
                'model_id' => $model_id
            ])
        ) {
            $this->modx->error->addField('field_id', $this->modx->lexicon('pb_object_err_ae'));
        }

        $this->properties['menuindex'] = $this->modx->getCount($this->classKey, [
            'model_type' => $this->model_type,
            'model_id' => $this->properties['model_id'],
        ]);

        return true;
    }

}

return 'pbTableColumnCreateProcessor';