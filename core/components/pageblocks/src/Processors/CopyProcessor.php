<?php

namespace Boshnik\PageBlocks\Processors;

trait CopyProcessor
{
    /**
     * Copy object
     * @param $object
     * @param $param (new properties)
     */
    public function copyObject($object, $param)
    {
        $param['menuindex'] = $this->modx->getCount($object->_class, [
            'model_type' => $param['model_type'],
            'model_id' => $param['model_id'],
            'context_key' => $param['context_key'],
        ]);

        $newObject = $this->modx->newObject($object->_class);
        $newObject->fromArray(array_merge($object->toArray(), $param));
        $newObject->createdon = time();
        $newObject->editedby = $this->modx->user->id;
        $newObject->editedon = time();
        if (!$newObject->save()) $this->failure('', $object->toArray());

        $this->copyChildObjects($object, $newObject);

        return $newObject;
    }

    /**
     * Copy child objects
     * @param $object
     * @param $newObject
     * @param int $update
     * @return boolean
     */
    public function copyChildObjects($object, $newObject, $update = 0)
    {
        if ($object->_class == 'pbFile') return false;

        $constructor = $object->getOne('Constructor');
        $object->_relatedObjects['Fields'] = [];
        $fields = $object->getMany('Fields', ['type:IN' => [
            'pb-table',
        ]]);

        foreach ($fields as $field) {
            $rows = $this->getCollection($this->classMap[$field->type], [
                'model_type' => $constructor->_class,
                'model_id' => $object->id,
                'context_key' => $object->context_key,
                'field_id' => $field->id,
                'deleted' => 0
            ]);
            foreach ($rows as $row) {
                $this->copyObject($row, [
                    'model_type' => $constructor->_class,
                    'model_id' => $newObject->id,
                    'context_key' => $newObject->context_key,
                    'field_id' => $row->field_id,
                    'collection_id' => $row->collection_id,
                ]);
            }
        }

        return true;
    }
}