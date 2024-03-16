<?php

class parseVideoProcessor extends modProcessor
{

    public function process()
    {
        $value = $this->properties['value'];
        if (empty($value)) {
            return $this->failure($this->modx->lexicon('pb_video_url_empty'));
        }

        $data = $this->properties['data'];
        if (empty($data)) {
            if (strripos($value, 'http') === false) {
                if (exif_imagetype(MODX_BASE_PATH . $value) !== false) {
                    return $this->failure($this->modx->lexicon('pb_not_video'));
                }
            } else {
                $info = pathinfo($value);
                // TODO
                if (!in_array($info['extension'], ['mp4','aac','wav','au','wmv','avi','mpg','mpeg'])) {
                    return $this->failure($this->modx->lexicon('pb_not_video'));
                }
            }
            $data = ['provider' => 'video'];
        } else {
            $data = json_decode($data,1);
            if ($data['mediaType'] !== 'video') {
                return $this->failure($this->modx->lexicon('pb_video_url_invalid'));
            }
        }


        $output = [];
        switch ($data['provider']) {
            case 'youtube':
                // https://developers.google.com/youtube/v3/getting-started
                $youtube_api_key = $this->modx->getOption('pageblocks_youtube_api_key', '', 'AIzaSyCEIe9Y_s25uaEeY3qaFjlhckdvRE1MP1M', true);
                $hash = json_decode($this->curl_get_file_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails&id=".$data['id']."&key=".$youtube_api_key.""));

                // thumbnail:
                // '120x90' => 'default',
                // '320x180' => 'medium',
                // '480x360' => 'high',
                // '640x480' => 'standard',
                // '1280x720' => 'maxres',

                $output = [
                    'provider'          => $data['provider'],
                    'title'             => $hash->items[0]->snippet->title,
                    'description'       => str_replace(array("", "<br/>", "<br />"), NULL, $hash->items[0]->snippet->description),
//                    'description_nl2br' => str_replace(array("\n", "\r", "\r\n", "\n\r"), NULL, nl2br($hash->items[0]->snippet->description)),
                    'thumbnail'         => [
                        'default' => [
                            'url' => $hash->items[0]->snippet->thumbnails->default->url,
                            'width' => $hash->items[0]->snippet->thumbnails->default->width,
                            'height' => $hash->items[0]->snippet->thumbnails->default->height,
                        ],
                        'medium' => [
                            'url' => $hash->items[0]->snippet->thumbnails->medium->url,
                            'width' => $hash->items[0]->snippet->thumbnails->medium->width,
                            'height' => $hash->items[0]->snippet->thumbnails->medium->height,
                        ],
                        'high' => [
                            'url' => $hash->items[0]->snippet->thumbnails->high->url,
                            'width' => $hash->items[0]->snippet->thumbnails->high->width,
                            'height' => $hash->items[0]->snippet->thumbnails->high->height,
                        ],
                        'standard' => [
                            'url' => $hash->items[0]->snippet->thumbnails->standard->url,
                            'width' => $hash->items[0]->snippet->thumbnails->standard->width,
                            'height' => $hash->items[0]->snippet->thumbnails->standard->height,
                        ],
                        'maxres' => [
                            'url' => $hash->items[0]->snippet->thumbnails->maxres->url,
                            'width' => $hash->items[0]->snippet->thumbnails->maxres->width,
                            'height' => $hash->items[0]->snippet->thumbnails->maxres->height,
                        ]
                    ],
                    'preview'           => $hash->items[0]->snippet->thumbnails->high->url,
                    'url'               => "https://www.youtube.com/watch?v=" . $data['id'],
                    'embed_video'       => "https://www.youtube.com/embed/" . $data['id'],
                    'video_id'          => $data['id'],
                ];
                break;
            // TODO
            case 'vimeo':
                // https://developer.vimeo.com/apps
                $vimeo_api_key = $this->modx->getOption('pageblocks_vimeo_api_key', '', '33fa5d8055bba5e10bad50efd9856c52', true);
                $options = array('http' => array(
                    'method'  => 'GET',
                    'header' => 'Authorization: Bearer '.$vimeo_api_key
                ));
                $context  = stream_context_create($options);
                $hash = json_decode($this->curl_get_file_contents("https://api.vimeo.com/videos/{$data['id']}",false, $context));

                // thumbnail:
                // '100x75' => 0,
                // '200x150' => 1,
                // '295x166' => 2,
                // '640x360' => 3,
                // '960x540' => 4,
                // '1280x720' => 5,
                // '1920x1080' => 6,

                $output = [
                    'provider'          => $data['provider'],
                    'title'             => $hash->name,
                    'description'       => str_replace(array("<br>", "<br/>", "<br />"), NULL, $hash->description),
//                    'description_nl2br' => str_replace(array("\n", "\r", "\r\n", "\n\r"), NULL, $hash->description),
                    'thumbnail'         => $hash->pictures->sizes[3]->link,
                    'thumbnail_width'   => $hash->pictures->sizes[3]->width,
                    'thumbnail_height'  => $hash->pictures->sizes[3]->height,
                    'url'             => $hash->link,
                    'embed_video'       => "https://player.vimeo.com/video/" . $data['id'],
                    'video_id'          => $data['id'],
                ];
                break;
            case 'video':
                $output = [
                    'provider' => 'video',
                    'url' => $value,
                    'embed_video' => $value,
                    'pathinfo' => pathinfo($value),
                ];
                break;
            default:
                return $this->failure($this->modx->lexicon('pb_video_provider_no_support', [
                    'name' => $data['provider']
                ]));
        }

        return $this->success('', $output);
    }


    /**
     * @param $URL
     * @return bool|string
     */
    public function curl_get_file_contents($URL)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
        else return FALSE;
    }

}

return 'parseVideoProcessor';