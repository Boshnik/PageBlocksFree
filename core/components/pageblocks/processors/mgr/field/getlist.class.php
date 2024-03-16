<?php

use Boshnik\PageBlocks\Processors\HelpProcessor;
use Boshnik\PageBlocks\Processors\QueryProcessor;

class pbFieldGetListProcessor extends modObjectGetListProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbField::class;
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';

    use HelpProcessor;
    use QueryProcessor;

    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c->where([
            'model_type' => $this->properties['model_type'],
            'model_id' => $this->properties['model_id'] ?? 0,
        ]);

        if ($this->properties['combo']) {
            $c->select('id,caption');
            $c->where([
                'published' => 1
            ]);
        }

        if (isset($this->properties['published'])) {
            $c->where([
                'published' => 1
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
            return [
                'id' => $object->id,
                'caption' => $object->caption,
            ];
        }

        $array = $object->toArray();
        $properties = json_decode($array['properties'], 1);
        if (is_array($properties)) {
            $array = array_merge($array, $properties);
        }

        $fieldType = str_replace(['pb-panel-', 'pb-', 'modx-'], '', $array['type']);
        $fieldType = str_replace('-', '_', $fieldType);
        $array['type_lexicon'] = $this->modx->lexicon('pb_field_type_' . $fieldType);
        if ($array['type'] == 'pb-table' && isset($array['table_id'])) {
            $array['table_columns'] = $this->getTableColumns($array['table_id']);
        }
        if ($array['tab_id']) {
            $tab = $object->getOne('Tab');
            $array['tab_name'] = $tab->name;
            $array['tab_rank'] = $tab->menuindex;
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
            'button' => true,
            'menu' => true,
        ];

        return $array;
    }

}

return 'pbFieldGetListProcessor';