<?php

namespace Boshnik\PageBlocks;


use modX;
use Boshnik\PageBlocks\Processors\CopyProcessor;
use Boshnik\PageBlocks\Processors\MediaSourceProcessor;
use Boshnik\PageBlocks\Processors\FileProcessor;
use Boshnik\PageBlocks\Processors\HelpProcessor;
use Boshnik\PageBlocks\Processors\QueryProcessor;
use Boshnik\PageBlocks\Processors\ValuesProcessor;

/**
 * class PageBlocks
 */
class PageBlocks
{
    use CopyProcessor;
    use MediaSourceProcessor;
    use FileProcessor;
    use HelpProcessor;
    use QueryProcessor;
    use ValuesProcessor;

    /**
     * The namespace
     * @var string $namespace
     */
    public string $namespace = 'pageblocks';

    /**
     * The version
     * @var string $version
     */
    public string $version = '1.0.1-pl';


    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(public modX $modx, public array $config = [])
    {
        $corePath = MODX_CORE_PATH . 'components/pageblocks/';
        $assetsUrl = MODX_ASSETS_URL . 'components/pageblocks/';

        $modxversion = $this->modx->getVersionData();

        $this->config = array_merge([
            'namespace' => $this->namespace,
            'version' => $this->version,
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'processorsPath' => $corePath . 'processors/',
            'connectorUrl' => $assetsUrl . 'connector.php',
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',

            'modxversion' => $modxversion['version'],
            'is_admin' => $this->modx->user->isMember('Administrator'),
        ], $config);

        $this->modx->addPackage($this->namespace, $this->config['modelPath']);
        $this->modx->lexicon->load("$this->namespace:default");
        $this->modx->lexicon->load("core:tv_input_types");
    }

    /**
     * @param string $action
     * @param array $data
     * @return false
     */
    public function runProcessor($action = '', $data = [])
    {
        if (empty($action)) {
            return false;
        }
        $this->modx->error->reset();
        $processorsPath = !empty($this->config['processorsPath'])
            ? $this->config['processorsPath']
            : MODX_CORE_PATH . 'components/pageblocks/processors/';

        return $this->modx->runProcessor($action, $data, [
            'processors_path' => $processorsPath,
        ]);
    }
}