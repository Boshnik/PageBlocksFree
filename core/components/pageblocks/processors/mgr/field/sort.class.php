<?php

require_once dirname(__DIR__, 2) . '/all/sort.class.php';

class pbFieldSortProcessor extends PageBlocksSortProcessor
{
    public $classKey = pbField::class;

    public function getCondition(): array
    {
        return [
            'model_type' => $this->target->model_type,
            'model_id' => $this->target->model_id,
        ];
    }
}

return 'pbFieldSortProcessor';