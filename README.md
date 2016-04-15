Storage translations in a database component for SkeekS CMS
===================================

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist skeeks/cms-cms-i18n-db "*"
```

or add

```
"skeeks/cms-i18n-db": "*"
```


How to use
----------

### Configuration app
```php
//App config

'components' =>
[
    'i18n' => [
        'class'     => 'skeeks\cms\i18nDb\I18NDbComponent',
        'translations' =>
        [
            'skeeks/i18nDb/app' => [
                'class'             => 'yii\i18n\PhpMessageSource',
                'basePath'          => '@skeeks/cms/i18nDb/messages',
                'fileMap' => [
                    'skeeks/i18nDb/app' => 'app.php',
                ],
            ]
        ]
    ],
],
'modules' =>
[
    'i18nDb' => [
        'class'         => '\skeeks\cms\i18nDb\I18nDbModule',
    ]
]

```

___

> [![skeeks!](https://gravatar.com/userimage/74431132/13d04d83218593564422770b616e5622.jpg)](http://skeeks.com)
<i>SkeekS CMS (Yii2) — quickly, easily and effectively!</i>
[skeeks.com](http://skeeks.com) | [en.cms.skeeks.com](http://en.cms.skeeks.com) | [cms.skeeks.com](http://cms.skeeks.com) | [marketplace.cms.skeeks.com](http://marketplace.cms.skeeks.com)


