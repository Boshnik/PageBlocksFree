<?php

require_once dirname(__DIR__, 2) . '/all/sort.class.php';

class pbTableValueSortProcessor extends PageBlocksSortProcessor
{
    public $classKey = pbTableValue::class;

    public function getCondition(): array
    {
        return [
            'model_type' => $this->target->model_type,
            'model_id' => $this->target->model_id,
            'context_key' => $this->target->context_key,
            'field_id' => $this->target->field_id,
            'ef_field_id' => $this->target->ef_field_id,
        ];
    }
}

return 'pbTableValueSortProcessor';