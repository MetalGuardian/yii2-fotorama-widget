<?php

namespace yiiunit\widget;

use metalguardian\fotorama\Fotorama;
use Yii;
use yii\web\View;
use yiiunit\TestCase;

class PickerTest extends TestCase
{

    public function testEmptyElement()
    {
        $out = Fotorama::widget(
            [
                'id' => 'fotorama',
            ]
        );
        $this->assertEqualsWithoutLE('<div id="fotorama" data-auto="false">' . "\n" . '</div>', $out);
    }

    public function testDataAndSpinnerInOptions()
    {
        $out = Fotorama::widget(
            [
                'id' => 'fotorama',
                'options' => [
                    'nav' => 'thumbs',
                    'data' => [
                        ['img' => 'http://s.fotorama.io/1.jpg', 'id' => 'id-one',],
                        ['img' => 'http://s.fotorama.io/2.jpg',],
                        ['img' => 'http://s.fotorama.io/3.jpg',],
                        ['img' => 'http://s.fotorama.io/4.jpg',],
                    ],
                    'spinner' => [
                        'lines' => 13,
                    ],
                ],
            ]
        );
        $this->assertEqualsWithoutLE('<div id="fotorama" data-nav="thumbs" data-auto="false">' . "\n" . '</div>', $out);
    }

    public function testDefaults()
    {
        Fotorama::setDefaults(
            [
                'nav' => 'thumbs',
                'spinner' => [
                    'lines' => 20,
                ],
                'loop' => true,
                'hash' => true,
            ]
        );
        $out = Fotorama::widget(
            [
                'id' => 'fotorama',
            ]
        );
        $this->assertEqualsWithoutLE('<div id="fotorama" data-auto="false">' . "\n" . '</div>', $out);
    }

    public function testDefaultsJs()
    {
        $widget = Fotorama::begin(
            [
                'id' => 'fotorama',
            ]
        );
        $view = Yii::$app->getView();
        $widget->setView($view);
        $widget->run();

        $defaults = [
            'nav' => 'thumbs',
            'spinner' => [
                'lines' => 20,
            ],
            'loop' => true,
            'hash' => true,
        ];
        Fotorama::setDefaults(
            $defaults
        );

        $test = 'fotoramaDefaults = ' . json_encode($defaults) . ';';
        $this->assertEquals($test, $view->js[View::POS_HEAD]['fotorama-defaults']);
    }


    public function testRegisteredJs()
    {
        $widget = Fotorama::begin([
            'id' => 'fotorama',
        ]);
        $widget->run();

        $view = $this->getView();
        $widget->setView($view);
        $widget->registerJs(View::POS_READY, 'fotorama-widget');

        $test = <<<JS
jQuery("#fotorama").fotorama();
JS;
        $this->assertEquals($test, $view->js[View::POS_READY]['fotorama-widget']);
    }

    public function testHtmlList()
    {
        ob_start();
        $fotorama = \metalguardian\fotorama\Fotorama::begin(
            [
                'options' => [
                    'loop' => true,
                    'hash' => true,
                    'ratio' => 800/600,
                ],
                'spinner' => [
                    'lines' => 20,
                ],
                'tagName' => 'span',
                'useHtmlData' => false,
                'htmlOptions' => [
                    'class' => 'custom-class',
                    'id' => 'custom-id',
                ],
            ]
        );
?>
<img src="http://s.fotorama.io/1.jpg">
<img src="http://s.fotorama.io/2.jpg">
<img src="http://s.fotorama.io/3.jpg">
<img src="http://s.fotorama.io/4.jpg">
<img src="http://s.fotorama.io/5.jpg">
<?php
        $fotorama->end();
        $out = ob_get_clean();

        $except = <<<HTML
<span id="custom-id" class="custom-class" data-auto="false">
<img src="http://s.fotorama.io/1.jpg">
<img src="http://s.fotorama.io/2.jpg">
<img src="http://s.fotorama.io/3.jpg">
<img src="http://s.fotorama.io/4.jpg">
<img src="http://s.fotorama.io/5.jpg">
</span>
HTML;

        $this->assertEqualsWithoutLE($except, $out);
    }
}
