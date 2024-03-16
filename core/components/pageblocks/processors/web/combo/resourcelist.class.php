<?php

class pbResourceGetListProcessor extends modObjectGetListProcessor
{
    public $classKey = modResource::class;
    public $languageTopics = ['resource'];
    public $defaultSortField = 'pagetitle';


    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        if (isset($this->properties['where'])) {
            $where = json_decode($this->properties['where'],1);
            foreach ($where as $cr) {
                $c->where($cr);
            }
        }

        if ($this->properties['combo']) {
            $c->select('id,pagetitle');
        }
        if (isset($this->properties['id'])) {
            $c->where(['id' => $this->properties['id']]);
        }
        $query = trim($this->properties['query']);
        if (!empty($query)) {
            $c->where(['pagetitle:LIKE' => "%{$query}%"]);
        }

        return $c;
    }


    /**
     * @param xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        if ($this->properties['combo']) {
            $array = [
                'id' => $object->id,
                'pagetitle' => '(' . $object->id . ') ' . $object->pagetitle,
            ];
        } else {
            $array = $object->toArray();
        }

        return $array;
    }
}

return 'pbResourceGetListProcessor';