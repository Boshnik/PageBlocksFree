<?php

class pbBlockGetListProcessor extends modObjectGetListProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbBlock::class;
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';



    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $query = trim($this->properties['query']);
        if ($query && !$this->properties['combo']) {
            $c->where([
                'name:LIKE' => "%{$query}%",
            ]);
        }

        if ($this->properties['combo']) {
            $c->select('id,name,ab_templates,ab_parents,ab_resources');
            $c->where([
                'published' => 1,
            ]);
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

        if ($this->properties['combo']) {

            if (!empty($object->ab_templates)) {
                $templates = explode('||', $object->ab_templates);
                if (!in_array($this->properties['template_id'], $templates)) {
                    return false;
                }
            }

            if (!empty($object->ab_parents)) {
                $parents = explode(',', $object->ab_parents);
                if (!in_array($this->properties['parent_id'], $parents)) {
                    return false;
                }
            }

            if (!empty($object->ab_resources)) {
                $resources = explode(',', $object->ab_resources);
                if (!in_array($this->properties['resource_id'], $resources)) {
                    return false;
                }
            }

            return [
                'constructor_id' => $object->id,
                'name' => $object->name,
            ];
        }

        $array = $object->toArray();
        $array['actions'] = [];

        // Edit
        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-edit',
            'title' => $this->modx->lexicon('pb_row_update'),
            //'multiple' => $this->modx->lexicon('pb_rows_update'),
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

return 'pbBlockGetListProcessor';