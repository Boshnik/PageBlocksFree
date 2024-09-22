<?php

class pbBlockValueGetListProcessor extends modObjectGetListProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbBlockValue::class;
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';


    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(\xPDOQuery $c)
    {
        $c->where([
            'model_type' => $this->properties['model_type'],
            'model_id' => $this->properties['model_id'],
            'context_key' => $this->properties['context_key'],
            'deleted' => $this->properties['deleted'] ?? 0,
        ]);

        if (isset($this->properties['published'])) {
            $c->where([
                'published' => $this->properties['published'],
            ]);
        }

        if (isset($this->properties['where'])) {
            $where = json_decode($this->properties['where'],1);
            foreach ($where as $cr) {
                $c->where($cr);
            }
        }

        $query = trim($this->properties['query']);
        if ($query) {
            $c->select($this->modx->getSelectColumns($this->classKey, $this->classKey));
            $c->leftJoin('pbBlock', 'pbBlock', 'pbBlockValue.constructor_id = pbBlock.id');
            $c->select($this->modx->getSelectColumns('pbBlock', 'pbBlock', '', ['name']));
            $c->where([
                'pbBlockValue.id' => $query,
                'OR:pbBlock.name:LIKE' => "%{$query}%"
            ]);
        }

        if ($this->properties['combo']) {
            $c->select('id','name');
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
        $constructor = $object->getOne('Constructor');
        if ($this->properties['combo']) {
            return [
                'constructor_id' => $constructor->id,
                'name' => $constructor->name,
            ];
        }

        $array = $object->toArray();
        $array['block_name'] = $constructor->name;
        $array['values'] = $object->getColumnValues();
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
            'button' => true,
            'menu' => true,
        ];

        return $array;
    }

}

return 'pbBlockValueGetListProcessor';