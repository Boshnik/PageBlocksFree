<?php

class PageBlocksSortProcessor extends modObjectProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbBlock::class;
    public $target = null;
    public $sources = null;
    public array $where = [];

    public function initialize()
    {
        $this->target = $this->modx->getObject($this->classKey, ['id' => $this->properties['target'] ?? 0]);
        if (!$this->target) {
            return false;
        }

        $this->sources = json_decode($this->properties['sources'], true);
        if (!is_array($this->sources)) {
            return $this->failure();
        }

        $this->where = $this->getCondition();



        return true;
    }

    public function getCondition(): array
    {
        return [];
    }

    public function process()
    {
        foreach ($this->sources as $id) {
            $source = $this->modx->getObject($this->classKey, compact('id'));
            $this->sort($source, $this->target, $this->where);
        }
        $this->updateIndex($this->where);

        return $this->success();
    }

    public function sort($source, $target, $where = [])
    {
        $c = $this->modx->newQuery($this->classKey);
        $c->command('UPDATE');
        if (count($where)) {
            $c->where($where);
        }
        if ($source->get('menuindex') < $target->get('menuindex')) {
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


    public function updateIndex(array $where = []): void
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
        if (count($where)) {
            $c->where($where);
        }
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

return 'PageBlocksSortProcessor';