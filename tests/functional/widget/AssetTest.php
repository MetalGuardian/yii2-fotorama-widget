<?php

namespace yiiunit\widget;

use metalguardian\fotorama\Fotorama;
use metalguardian\fotorama\FotoramaAsset;
use yii\web\AssetBundle;
use yiiunit\TestCase;

class AssetTest extends TestCase
{
    public function testRegister()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        FotoramaAsset::register($view);
        $this->assertEquals(2, count($view->assetBundles));
        $this->assertArrayHasKey('yii\\web\\JqueryAsset', $view->assetBundles);
        $this->assertTrue($view->assetBundles['metalguardian\fotorama\FotoramaAsset'] instanceof AssetBundle);
        $content = $view->renderFile('@yiiunit/views/rawlayout.php');
        $this->assertContains('fotorama.css', $content);
        $this->assertContains('jquery.js', $content);
        $this->assertContains('fotorama.js', $content);
    }

    public function testRegisterCDN()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        FotoramaAsset::register($view)->version = true;
        $this->assertEquals(2, count($view->assetBundles));
        $this->assertArrayHasKey('yii\\web\\JqueryAsset', $view->assetBundles);
        $this->assertTrue($view->assetBundles['metalguardian\fotorama\FotoramaAsset'] instanceof AssetBundle);
        $content = $view->renderFile('@yiiunit/views/rawlayout.php');
        $this->assertContains(FotoramaAsset::CDN_SOURCE_PATH . Fotorama::VERSION . '/fotorama.css', $content);
        $this->assertContains('jquery.js', $content);
        $this->assertContains(FotoramaAsset::CDN_SOURCE_PATH . Fotorama::VERSION . '/fotorama.js', $content);
    }
}
