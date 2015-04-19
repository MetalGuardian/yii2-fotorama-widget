<?php
/**
 * Author: MetalGuardian
 */

namespace metalguardian\fotorama;

use yii\web\AssetBundle;

/**
 * Class FotoramaAsset
 *
 * @package metalguardian\fotorama
 */
class FotoramaAsset extends AssetBundle
{
    const CDN_SOURCE_PATH = '//cdnjs.cloudflare.com/ajax/libs/fotorama/';

    public $version = false;

    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/bower/fotorama';

    public $css = [
        'fotorama.css'
    ];

    public $js = [
        'fotorama.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function registerAssetFiles($view)
    {
        if ($this->version) {
            $version = is_string($this->version) ? $this->version : Fotorama::VERSION;
            $this->baseUrl = self::CDN_SOURCE_PATH . $version;
        }

        parent::registerAssetFiles($view);
    }
} 
