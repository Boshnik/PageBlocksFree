<?php

use Boshnik\PageBlocks\Processors\HelpProcessor;
class pbField extends xPDOSimpleObject
{
    use HelpProcessor;

    public function formatValue($value = '')
    {
        if (empty($value)) {
            return $value;
        }

        if (is_numeric($value)) {
            switch ($this->type) {
                case 'resourcelist':
                    $resource = $this->xpdo->getObject(modResource::class, $value);
                    if ($resource) {
                        return "($resource->id) " . $resource->pagetitle;
                    }
                    break;
            }

        } elseif (is_string($value)) {
            $value = $this->truncateTextByWords($value);
        }

        return $value;
    }

    public function getTabName()
    {
        return $this->getOne('Tab')->name;
    }
}