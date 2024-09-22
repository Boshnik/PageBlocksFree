<?php

require_once dirname(__DIR__, 2) . '/all/sort.class.php';

class pbTableSortProcessor extends PageBlocksSortProcessor
{
    public $classKey = pbTable::class;
}

return 'pbTableSortProcessor';