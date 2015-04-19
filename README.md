Fotorama Yii2 widget
====================
This yii2 extension is a wrapper for the powerful jQuery gallery Fotorama

Installation
------------

Install this extension using [composer](http://getcomposer.org/download/).

Run

```
php composer.phar require metalguardian/yii2-fotorama-widget "*"
```

or add

```
"metalguardian/yii2-fotorama-widget": "*"
```

to the require section of the `composer.json` file.


Usage
-----

First way:

```php

    <?php 
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
    <?php $fotorama->end(); ?>

```

Second way:

```php

    <?php 
    echo \metalguardian\fotorama\Fotorama::widget(
        [
            'items' => [
                ['img' => 'http://s.fotorama.io/1.jpg', 'id' => 'id-one',],
                ['img' => 'http://s.fotorama.io/2.jpg',],
                ['img' => 'http://s.fotorama.io/3.jpg',],
                ['img' => 'http://s.fotorama.io/4.jpg',],
            ],
            'options' => [
                'nav' => 'thumbs',
            ]
        ]
    ); 
    ?>

```

To use CDNJS put this before run widget, will be used current version:

```php

    <?php \metalguardian\fotorama\Fotorama::$useCDN = true; ?>

```

Or select custom version:

```php

    <?php \metalguardian\fotorama\Fotorama::$useCDN = '4.5.0'; ?>

```

To setup default Fotorama widget options to all galleries on page:

```php

    <?php 
    \metalguardian\fotorama\Fotorama::setDefaults(
        [
            'nav' => 'thumbs',
            'spinner' => [
                'lines' => 20,
            ],
            'loop' => true,
            'hash' => true,
        ]
    );
    ?>

```

For complete documentation of Fotorama and all widget options please refer to the [official Fotorama page](http://fotorama.io/)

License
-------

**yii2-fotorama-widget** is released under the MIT License. See the bundled `LICENSE` for details.
