<?php

class pbTableColumnSortProcessor extends modObjectProcessor
{
    public $classKey = pbTableColumn::class;
    public $model_type = 'pbTable';

    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->modx->getCount($this->classKey, $this->properties['target'])) {
            return $this->failure();
        }

        $sources = json_decode($this->properties['sources'], true);
        if (!is_array($sources)) {
            return $this->failure();
        }
        /** @var pbTableColumn $target */
        $target = $this->modx->getObject($this->classKey, [
            'id' => $this->properties['target']
        ]);
        $where = [
            'model_type' => $target->model_type,
            'model_id' => $target->model_id,
        ];
        foreach ($sources as $id) {
            /** @var pbTableColumn $source */
            $source = $this->modx->getObject($this->classKey, compact('id'));
            $this->sort($source, $target, $where);
        }
        $this->updateIndex($where);

        return $this->modx->error->success();
    }


    /**
     * @param pbTableColumn $source
     * @param pbTableColumn $target
     * @param array $where
     */
    public function sort(pbTableColumn $source, pbTableColumn $target, $where = [])
    {
        $c = $this->modx->newQuery($this->classKey);
        $c->command('UPDATE');
        $c->where($where);
        if ($source->menuindex < $target->menuindex) {
            $c->query['set']['menuindex'] = [
                'value' => '`menuindex` - 1',
                'type' => false,
            ];
            $c->andCondition([
                'menuindex:<=' => $target->menuindex,
                'menuindex:>' => $source->menuindex,
            ]);
            $c->andCondition([
                'menuindex:>' => 0,
            ]);
        } else {
            $c->query['set']['menuindex'] = [
                'value' => '`menuindex` + 1',
                'type' => false,
            ];
            $c->andCondition([
                'menuindex:>=' => $target->menuindex,
                'menuindex:<' => $source->menuindex,
            ]);
        }
        $c->prepare();
        $c->stmt->execute();

        $source->set('menuindex', $target->menuindex);
        $source->save();
    }


    /**
     * @param array $where
     */
    public function updateIndex($where = [])
    {
        // Check if need to update indexes
        $c = $this->modx->newQuery($this->classKey);
        $c->groupby('menuindex');
        $c->select('COUNT(menuindex) as idx');
        $c->sortby('idx', 'DESC');
        $c->limit(1);
        if ($c->prepare() && $c->stmt->execute()) {
            if ($c->stmt->fetchColumn() == 1) {
                return;
            }
        }

        // Update indexes
        $c = $this->modx->newQuery($this->classKey);
        $c->where($where);
        $c->select('id');
        $c->sortby('menuindex ASC, id', 'ASC');
        if ($c->prepare() && $c->stmt->execute()) {
            $table = $this->modx->getTableName($this->classKey);
            $update = $this->modx->prepare("UPDATE {$table} SET menuindex = ? WHERE id = ?");
            $i = 0;
            while ($id = $c->stmt->fetch(PDO::FETCH_COLUMN)) {
                $update->execute([$i, $id]);
                $i++;
            }
        }
    }
}

return 'pbTableColumnSortProcessor';