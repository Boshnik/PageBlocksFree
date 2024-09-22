<?php
class pbBlockValue extends xPDOSimpleObject
{
    public function getColumnValues()
    {
        $values = json_decode($this->values,1);
        $constructor = $this->getOne('Constructor');
        if (!$constructor) {
            return '';
        }
        $fields = $constructor->getMany('Fields');

        ob_start();
        foreach ($fields as $field) {
            if (isset($values[$field->name]) && !in_array($field->type, ['modx-texteditor', 'editorjs'])) {
                $value = $field->formatValue($values[$field->name]);
                echo "<b>{$field->caption}:</b> $value<br>";
            }
        }

        return ob_get_clean();
    }
}