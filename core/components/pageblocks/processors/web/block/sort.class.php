<?php

require_once dirname(__DIR__, 2) . '/all/sort.class.php';

class pbBlockValueSortProcessor extends PageBlocksSortProcessor
{
    public $classKey = pbBlockValue::class;

    public function getCondition(): array
    {
        return [
            'model_type' => $this->target->model_type,
            'model_id' => $this->target->model_id,
            'context_key' => $this->target->context_key,
        ];
    }
}

return 'pbBlockValueSortProcessor';