<?php

class pbTableValueGetListProcessor extends modObjectGetListProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbTableValue::class;
    public $idx = 0;

    /**
     * {@inheritDoc}
     * @return mixed
     */
    public function process() {
        $beforeQuery = $this->beforeQuery();
        if ($beforeQuery !== true) {
            return $this->failure($beforeQuery);
        }

        if ($this->properties['data_type'] === 'local') {
            $list = array_map(function ($array) {
                $values = json_decode($array['values'],1);
                foreach ($values as $name => $value) {
                    $array[$name] = $value;
                    if (is_array($value) && isset($value['url'])) {
                        $array[$name] = $value['url'];
                    }
                }
                return $array;
            }, json_decode($this->properties['values'],1));
            $data = ['total' => count($list)];
        } else {
            $data = $this->getData();
            $list = $this->iterate($data);
        }

        return $this->outputArray($list, $data['total']);
    }

    /**
     * @param xPDOQuery $c
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {

        if ($this->properties['combo']) {
            if (!isset($this->properties['displayfield']) || empty($this->properties['displayfield'])) {
                $this->properties['displayfield'] = 'name';
            }
            if (isset($this->properties['where'])) {
                $where = json_decode($this->properties['where'],1);
                foreach ($where as $cr) {
                    $c->where($cr);
                }
            }
            $c->where([
                'published' => 1,
                'deleted' => 0,
            ]);
            $c->select('id,values,alias');
        } else {
            $c->where([
                'model_id' => (int) $this->properties['model_id'] ?: 0,
                'field_id' => (int) $this->properties['field_id'],
                'collection_id' => (int) $this->properties['collection_id'] ?: 0,
                'deleted' => $this->properties['deleted'] ?? 0,
            ]);

            if ($this->properties['collection_id']) {
                $c->where([
                    'model_id' => $this->properties['model_id'],
                    'context_key' => $this->properties['context_key']
                ]);
            }
        }

        return $c;
    }


    /**
     * @param xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $array = $object->toArray();
        $array['idx'] = ++$this->idx;

        // getColumnValues
        $fields = $object->getMany('Fields');
        foreach ($fields as $field) {
            $name = $field->name;
            if (isset($values[$name])) {
                $array[$name] = $field->formatValue($values[$name]);
            }
        }

        $values = json_decode($array['values'],1);
        foreach ($values as $name => $value) {
            if (!isset($array[$name])) {
                $array[$name] = $value;
                if (is_array($value) && isset($value['url'])) {
                    $array[$name] = $value['url'];
                }
            }
        }

        if ($this->properties['combo']) {
            return [
                'id' => $object->id,
                $this->properties['displayfield'] => '(' . $object->id . ') ' . $values[$this->properties['displayfield']],
            ];
        }

        $array['actions'] = [];

        // Edit
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-edit',
            'title' => $this->modx->lexicon('pb_row_update'),
            'action' => 'updateObject',
            'button' => true,
            'menu' => true,
        ];

        // Copy
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-copy',
            'title' => $this->modx->lexicon('pb_row_copy'),
            'action' => 'copyObject',
            'button' => true,
            'menu' => true,
        ];

        if (!$array['published']) {
            $array['actions'][] = [
                'cls' => '',
                'icon' => 'icon icon-power-off action-green',
                'title' => $this->modx->lexicon('pb_row_enable'),
                'multiple' => $this->modx->lexicon('pb_rows_enable'),
                'action' => 'enableObject',
                'button' => true,
                'menu' => true,
            ];
        } else {
            $array['actions'][] = [
                'cls' => '',
                'icon' => 'icon icon-power-off action-gray',
                'title' => $this->modx->lexicon('pb_row_disable'),
                'multiple' => $this->modx->lexicon('pb_rows_disable'),
                'action' => 'disableObject',
                'button' => true,
                'menu' => true,
            ];
        }

        // Remove
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-trash-o action-red',
            'title' => $this->modx->lexicon('pb_row_remove'),
            'multiple' => $this->modx->lexicon('pb_rows_remove'),
            'action' => 'removeObject',
            'remove' => true,
            'button' => true,
            'menu' => true,
        ];

        return $array;
    }

}

return 'pbTableValueGetListProcessor';