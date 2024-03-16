<?php

class pbFieldGetProcessor extends modObjectGetProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbField::class;
    public $languageTopics = ['pageblocks:default'];
    //public $permission = 'view';


    /**
     * Return the response
     * @return array
     */
    public function cleanup()
    {
        $array = $this->object->toArray();
        $properties = json_decode($array['properties'], 1);
        if (is_array($properties)) {
            $array = array_merge($array, $properties);
        }

        return $this->success('',$array);
    }
}

return 'pbFieldGetProcessor';