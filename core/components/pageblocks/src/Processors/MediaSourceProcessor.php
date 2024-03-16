<?php

namespace Boshnik\PageBlocks\Processors;

/**
 * Docs
 * https://github.com/modxcms/revolution/blob/8efb61f5d1/core/model/modx/sources/modfilemediasource.class.php
 */

use \modMediaSource;

trait MediaSourceProcessor {

    /** @var \modMediaSource $source */
    public $source;


    public function updateContainer($field, $object)
    {
        if ($mediaSource = $this->getSource($field->source)) {
            $dirs = explode('/', trim($field->source_path, '/'));
            $newPath = '/';
            foreach ($dirs as $dir) {
                $newPath .= "$dir/";
                if ($dir !== '[[+id]]') continue;
                $oldPath = str_replace('[[+resource_id]]', $object->model_id, $newPath);
                $oldPath = str_replace('[[+id]]', "temp{$field->id}", $oldPath);
                if (!empty($oldPath)) {
                    $mediaSource->renameContainer($oldPath, $object->id);
                }
            }
        }
    }

    public function uploadObjectsToContainer($path, $files = [])
    {
        foreach ($files as &$file) {
            $file['name'] = $this->getFileName($file['name']);
        }

        return $this->source->uploadObjectsToContainer($path, $files);
    }

    public function getSource($source) {
        $this->modx->loadClass('sources.modMediaSource');
        $this->source = \modMediaSource::getDefaultSource($this->modx, $source);
        if (!$this->source->getWorkingContext()) {
            return false;
        }
        $this->source->setRequestProperties($this->getProperties());
        if (!$this->source->initialize()) {
            return false;
        }

        $this->source->errors = [];

        return $this->source;
    }

    public function getSourcePath($path)
    {
        $path = $path !== '/' ? $this->sanitize($path) : $path;
        if (empty($path)) {
            $path = $this->modx->getOption('pageblocks_source_path');
        }

        return $path;
    }

}