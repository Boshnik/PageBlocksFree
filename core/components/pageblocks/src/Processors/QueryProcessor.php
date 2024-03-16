<?php

namespace Boshnik\PageBlocks\Processors;

trait QueryProcessor
{

    public $classMap = [
        'pb-table' => \pbTableValue::class,
    ];

    public function getDataTableColumns($table)
    {
        $q = $this->modx->prepare("DESCRIBE " . $this->modx->getTableName($table));
        $q->execute();
        $columns = $q->fetchAll(\PDO::FETCH_COLUMN);

        return $columns;
    }

    /**
     * @param $className
     * @param array $where
     * @param string $sortby
     * @param string $sortdir
     * @return mixed
     */
    public function getCollection($className, $where = [], $sortby = 'menuindex', $sortdir = 'asc')
    {
        $q = $this->modx->newQuery($className);
        $q->where($where);
        $q->sortby($sortby, $sortdir);
        $results = $this->modx->getCollection($className, $q);

        return $results;
    }

    /**
     * @param $className
     * @param array $where
     * @param string $sortby
     * @param string $sortdir
     * @return mixed
     */
    public function getFetchAll($className, $where = [], $sortby = 'menuindex', $sortdir = 'asc')
    {
        $q = $this->modx->newQuery($className);
        $q->select($this->modx->getSelectColumns($className, $className, '', '', false));
        $q->where($where);
        $q->sortby($sortby, $sortdir);
        $q->prepare();
        $q->stmt->execute();
        $results = $q->stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $results;
    }

    public function getTableIds($className, $where = [])
    {
        $query = $this->modx->newQuery($className);
        $query->select($this->modx->getSelectColumns($className, '', 'id'));
        $query->where($where);

        if ($query->prepare() && $query->stmt->execute()) {
            $ids = $query->stmt->fetchAll(\PDO::FETCH_COLUMN, 0);
        } else {
            $ids = [];
        }

        return $ids;
    }
}