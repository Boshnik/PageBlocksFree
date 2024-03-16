<?php

namespace Boshnik\PageBlocks\Processors;

trait RemoveProcessor
{
    public function removeChild($object)
    {
        $object->_relatedObjects['Fields'] = [];
        $fields = $object->getMany('Fields', ['type:IN' => [
            'pb-table',
        ]]);
        $constructor = $object->getOne('Constructor');
        foreach ($fields as $field) {
            $rows = $this->getCollection($this->classMap[$field->type], [
                'model_type' => $constructor->_class,
                'model_id' => $object->id,
                'context_key' => $object->context_key,
                'field_id' => $field->id,
            ]);
            foreach ($rows as $row) {
                if ($field->type == 'pb-table') {
                    $this->removeChild($row);
                }
                $row->remove();
            }
        }

        return true;
    }
}