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