<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 12.03.2015
 */
return [
    'other' => [
        'items' => [
            [
                "label" => \Yii::t('skeeks/i18nDb/app', "Database of translations"),
                "img"   => ['\skeeks\cms\i18nDb\assets\I18nDbAsset', 'icons/lang.png'],
                "items" => [
                    [
                        "label" => \Yii::t('skeeks/i18nDb/app', "Database of translations"),
                        "url"   => ["i18n/admin-message"],
                        "img"   => ['\skeeks\cms\i18nDb\assets\I18nDbAsset', 'icons/lang.png'],
                    ],
                ],
            ],
        ],
    ],
];