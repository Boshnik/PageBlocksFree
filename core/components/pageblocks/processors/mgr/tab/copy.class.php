<?php

class pbFieldTabCopyProcessor extends modObjectGetProcessor
{
    public $objectType = 'pb_object';
    public $classKey = pbFieldTab::class;
    public $languageTopics = ['pageblocks'];

    public function cleanup() {

        $array = $this->object->toArray();
        $array['menuindex'] = $this->modx->getCount($this->classKey, [
            'model_type' => $array['model_type'],
            'model_id' => $array['model_id'],
        ]);
        $array['name'] = $array['name'] . $array['menuindex'];

        $newObject = $this->modx->newObject($this->classKey);
        $newObject->fromArray($array, '', false, true);
        if (!$newObject->save()) $this->failure('',$array);

        return $this->success('',$array);
    }

}

return 'pbFieldTabCopyProcessor';