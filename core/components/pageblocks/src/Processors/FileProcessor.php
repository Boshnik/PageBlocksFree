<?php

namespace Boshnik\PageBlocks\Processors;

trait FileProcessor {

    public function updateFiles($object)
    {
        $object->_relatedObjects['Fields'] = [];
        $fields = $object->getMany('Fields', [
            'published' => 1,
            'type:IN' => [
                'pb-panel-file',
                'pb-panel-image',
                'pb-panel-video'
            ]
        ]);

        foreach ($fields as $field) {
            $properties = json_decode($field->properties, 1);
            if (is_array($properties)) {
                foreach ($properties as $name => $value) {
                    $field->set($name, $value);
                }
            }

            $values = str_replace("temp{$field->id}", $object->id, $object->values);
            $object->set('values', $values);
            $object->save();

            $this->updateContainer($field, $object);
        }
    }

    public function getFileInfo($file, $path)
    {
        $fileInfo = new \SplFileInfo($file);
        $extension = strtolower($fileInfo->getExtension());
        $filename = $this->getFileName($fileInfo->getFilename());
        $name = str_replace('.'. $extension, '', $filename);
        $source_url = $this->source->getBaseUrl();
        $url = str_replace('//', '/', "{$source_url}{$path}{$filename}");
        $url = ltrim($url, '/');
        $fullUrl = MODX_BASE_PATH . $url;

        // Get width and height
        $size = getimagesize($fullUrl);

        return [
            'title' => $filename,
            'name' => $name,
            'filename' => $filename,
            'extension' => $extension,
            'path' => $path,
            'url' => $url,
            'size' => filesize($fullUrl),
            'width' => $size !== false ? $size[0] : 0,
            'height' => $size !== false ? $size[1] : 0,
            'type' => $this->getFileType(MODX_SITE_URL . $url, $extension)
        ];
    }

    public function sanitize($file)
    {
        $file = rawurldecode($file);
        $file = strip_tags($file);
        $file = preg_replace('#\.(?![\w\-\~])#u', '', $file);
        $file = preg_replace('#\/{2,}#', '/', $file);
        $file = strip_tags($file);

        return trim($file, '/') . '/';
    }

    public function getFileName($filename)
    {
        $filename = mb_strtolower($filename);
        $filename = str_replace([' ', '_'], '-', strtolower($filename));

        return trim($filename, '-');
    }

    public function getFileType($url, $extension)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curl);
        $contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
        curl_close($curl);

        if (strpos($contentType, 'image/') === 0) {
            return 'image';
        } elseif (strpos($contentType, 'video/') === 0) {
            return 'video';
        } elseif (strpos($contentType, 'audio/') === 0) {
            return 'audio';
        } else {
            return $extension;
        }
    }

    public function handleResponse($response, $success = [])
    {
        if (empty($response)) {
            $errors = $this->source->getErrors();
            if (count($errors) > 1) {
                foreach ($errors as $key => $message) {
                    $this->modx->error->addField($key, $message);
                }

                return $this->failure();
            } else {
                return $this->failure(array_shift($errors));
            }
        }

        return $this->success(true, $success);
    }

}