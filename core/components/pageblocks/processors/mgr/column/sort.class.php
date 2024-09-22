<?php

require_once dirname(__DIR__, 2) . '/all/sort.class.php';

class pbTableColumnSortProcessor extends PageBlocksSortProcessor
{
    public $classKey = pbTableColumn::class;

    public function getCondition(): array
    {
        return [
            'model_type' => $this->target->model_type,
            'model_id' => $this->target->model_id,
        ];
    }

}

return 'pbTableColumnSortProcessor';