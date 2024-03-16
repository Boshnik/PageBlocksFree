<?php

use Boshnik\PageBlocks\Processors\QueryProcessor;
use Boshnik\PageBlocks\Processors\HelpProcessor;
use Boshnik\PageBlocks\Processors\MediaSourceProcessor;
use Boshnik\PageBlocks\Processors\FileProcessor;
use Boshnik\PageBlocks\Processors\ValuesProcessor;

class pbBlockValueGetProcessor extends modObjectGetProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbBlockValue::class;
    public $languageTopics = ['pageblocks'];

    use QueryProcessor;
    use HelpProcessor;
    use MediaSourceProcessor;
    use FileProcessor;
    use ValuesProcessor;

    /**
     * @return mixed
     */
    public function cleanup()
    {
        $array = $this->object->toArray();
        $values = json_decode($array['values'],1);
        foreach ($values as $name => $value) {
            $array[$name] = $value;
        }

        $constructor = $this->object->getOne('Constructor');
        $array['block_name'] = $constructor->name;

        $fields = $this->getCollection(pbField::class, [
            'model_type' => $constructor->_class,
            'model_id' => $constructor->id,
            'published' => 1,
        ]);
        $array['block_fields'] = [];
        foreach ($fields as $field) {
            $field_value = $field->toArray();
            $properties = json_decode($field_value['properties'], 1);
            if (is_array($properties)) {
                $field_value = array_merge($field_value, $properties);
            }

            if (isset($field_value['values']) && !empty($field_value['values'])) {
                $field_value['values'] = $this->processBindings($field_value['values']);
            }

            if ($field_value['type'] == 'pb-table' && isset($field_value['table_id'])) {
                $field_value['table_columns'] = $this->getTableColumns($field_value['table_id']);
            }

            if ($field_value['tab_id']) {
                $tab = $field->getOne('Tab');
                $field_value['tab_name'] = $tab->name;
                $field_value['tab_rank'] = $tab->menuindex;
            }
            $array['block_fields'][] = $field_value;
        }



        return $this->success('',$array);
    }

}

return 'pbBlockValueGetProcessor';