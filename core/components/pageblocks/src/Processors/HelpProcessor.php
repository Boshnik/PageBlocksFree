<?php

namespace Boshnik\PageBlocks\Processors;

use pbTableColumn;
use pbField;

trait HelpProcessor
{

    /**
     * Load rich text editor.
     */
    public function loadRichTextEditor()
    {
        $useEditor = $this->modx->getOption('use_editor');
        $whichEditor = $this->modx->getOption('which_editor');
        if ($useEditor && !empty($whichEditor)) {
            $onRichTextEditorInit = $this->modx->invokeEvent('OnRichTextEditorInit', [
                'editor' => $whichEditor
            ]);
            if (is_array($onRichTextEditorInit)) {
                $onRichTextEditorInit = implode('', $onRichTextEditorInit);
            }
            $this->modx->controller->addHtml($onRichTextEditorInit);
        }
    }

    public function getFieldProps()
    {
        $columns = $this->getDataTableColumns($this->classKey);
        $keysArray = array_flip($columns);
        $filteredData = array_diff_key($this->properties, $keysArray);
        foreach ($filteredData as $key => $value) {
            if (preg_match('/^ext-comp-\d+$/', $key)) {
                unset($filteredData[$key]);
            }
        }
        if (isset($filteredData['action'])) {
            unset($filteredData['action']);
        }

        return $filteredData;
    }

    /**
     * @param $field
     * @return array
     */
    public function getTableColumns($model_id)
    {
        $columns = [];
        $rows = $this->getCollection(pbTableColumn::class, [
            'model_id' => $model_id,
        ]);

        foreach ($rows as $row) {
            $data = $row->toArray();
            if ($column_field = $this->modx->getObject(pbField::class, $data['field_id'])) {
                $data['name'] = $column_field->name;
                $data['caption'] = $column_field->caption;
            }
            $columns[] = $data;
        }

        return $columns;
    }

    /**
     * @return array
     */
    public function getMediaSources()
    {
        $all = [];
        $sources = $this->modx->getCollection('sources.modMediaSource');
        foreach ($sources as $source) {
            $all[$source->id] = $source->getPropertyList();
        }
        return $all;
    }

    /**
     * @param $fields
     * @param $properties
     * @return array
     */
    public function filterValues($fields, $properties)
    {
        $values = [];
        foreach ($fields as $field) {
            if (isset($properties[$field->name])) {
                $values[$field->name] = $properties[$field->name];
            }
        }

        return $values;
    }

    /**
     * @param $fields
     * @param $values
     * @return mixed
     */
    public function prepareValues($fields, $values)
    {
        foreach ($fields as $field) {
            if (in_array($field->type, ['pb-panel-image', 'pb-panel-video', 'pb-panel-button']) && isset($values[$field->name])) {
                $values[$field->name] = json_decode($values[$field->name], 1);
            }
        }

        return $values;
    }

    /**
     * Change parent
     * @param $object
     */
    public function changeParent($object)
    {
        $object->_relatedObjects['Fields'] = [];
        $fields = $object->getMany('Fields', [
            'published' => 1,
            'type:IN' => [
                'pb-table',
                'pb-gallery',
            ]
        ]);
        $constructor = $object->getOne('Constructor');
        foreach ($fields as $field) {
            $items = $this->modx->getCollection($this->classMap[$field->type], [
                'model_type' => $constructor->_class,
                'model_id' => 0,
                'field_id' => $field->id,
            ]);
            foreach ($items as $item) {
                $item->set('model_id', $object->id);
                $item->save();
            }
        }
    }

    /**
     * Update values
     * @param $object
     */
    public function updateValues($object)
    {
        $values = json_decode($object->values,1);
        $object->_relatedObjects['Fields'] = [];
        $fields = $object->getMany('Fields', [
            'published' => 1,
            'type:IN' => [
                'pb-table',
                'pb-gallery',
            ]
        ]);
        foreach ($fields as $field) {
            $properties = json_decode($field->properties, 1);
            if (is_array($properties)) {
                foreach ($properties as $name => $value) {
                    $field->set($name, $value);
                }
            }

            $constructor = $object->getOne('Constructor');
            $values[$field->name] = $this->getValues($field->type, [
                'model_type' => $constructor->_class,
                'model_id' => $object->id,
                'field_id' => $field->id,
                'published' => 1,
                'deleted' => 0,
            ]);
        }
//        $values['object_id'] = $object->id;
        $object->set('values', json_encode($values, JSON_UNESCAPED_UNICODE));
        $object->save();
    }


    /**
     * @param $fieldType
     * @param array $where
     * @return array
     */
    public function getValues($fieldType, $where = [])
    {
        $values = [];
        $table = $this->classMap[$fieldType];
        $rows = $this->getFetchAll($table, $where);
        foreach ($rows as $row) {
            switch($fieldType) {
                case 'pb-gallery':
                    $values[] = array_intersect_key($row, array_flip([
                        'id', 'path', 'filename', 'extension', 'name', 'title',
                        'description', 'width', 'height', 'size', 'url',
                        'type', 'provider', 'preview', 'groups'
                    ]));
                    break;
                default:
                    $values[] = json_decode($row['values'],JSON_UNESCAPED_UNICODE);
            }

        }

        return $values;
    }

    public function truncateTextByWords($text, $wordLimit = 20)
    {
        if (empty($text) || !is_string($text)) {
            return $text;
        }
        $words = preg_split('/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY);
        if (count($words) <= $wordLimit) {
            return $text;
        }
        $truncatedWords = array_slice($words, 0, $wordLimit);
        $truncatedText = implode(' ', $truncatedWords) . '...';

        return $truncatedText;
    }
}