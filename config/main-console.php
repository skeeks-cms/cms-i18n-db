<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.06.2015
 */
return [

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
        'i18n' => [
            'class'                 => '\skeeks\cms\i18nDb\I18nDbModule',
            "controllerNamespace"   => 'skeeks\cms\i18nDb\console\controllers'
        ]
    ]

];