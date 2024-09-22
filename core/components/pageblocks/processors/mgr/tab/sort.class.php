<?php

require_once dirname(__DIR__, 2) . '/all/sort.class.php';

class pbFieldTabSortProcessor extends PageBlocksSortProcessor
{
    public $classKey = pbFieldTab::class;

    public function getCondition(): array
    {
        return [
            'model_type' => $this->target->model_type,
            'model_id' => $this->target->model_id,
        ];
    }
}

return 'pbFieldTabSortProcessor';