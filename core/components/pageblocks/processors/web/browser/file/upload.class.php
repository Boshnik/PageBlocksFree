<?php

use Boshnik\PageBlocks\Processors\MediaSourceProcessor;
use Boshnik\PageBlocks\Processors\FileProcessor;

class pbBrowserFileUploadProcessor extends modProcessor
{
    use MediaSourceProcessor;
    use FileProcessor;

    public function process()
    {
        $this->modx->lexicon->load('core:file');

        if (!$this->getSource($this->properties['source'])) {
            return $this->failure($this->modx->lexicon('permission_denied'));
        }

        $path = $this->getSourcePath($this->properties['source_path']);
        $dir = rtrim(MODX_BASE_PATH, '/') . $this->source->getBaseUrl() . $path;
        $this->modx->log(1, print_r($dir,1));
        if (file_exists($dir) === false) {
            $this->source->createContainer($path, '/');
        }

        $file = $_FILES[$this->properties['idFile']]['name'];
        $response = $this->uploadObjectsToContainer($path,$_FILES);

        return $this->handleResponse($response, $this->getFileInfo($file, $path));
    }

}

return  'pbBrowserFileUploadProcessor';