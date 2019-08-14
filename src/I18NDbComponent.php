<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\cms\i18nDb;

use skeeks\cms\i18nDb\models\SourceMessage;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\i18n\I18N;
use yii\i18n\MissingTranslationEvent;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class I18NDbComponent extends I18N
{
    /** @var array */
    public $missingTranslationHandler = ['skeeks\cms\i18nDb\I18NDbComponent', 'handleMissingTranslation'];

    /** @var string */
    public $sourceMessageTable = '{{%source_message}}';

    /** @var string */
    public $messageTable = '{{%message}}';

    public $db = 'db';

    public function getLanguages()
    {
        return array_keys(\Yii::$app->cms->languages);
    }

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        foreach ($this->translations as $key => $translateConfig) {
            if (!isset($this->translations[$key]['on missingTranslation'])) {
                if (!in_array($key, ['yii'])) {
                    $this->translations[$key]['on missingTranslation'] = $this->missingTranslationHandler;
                    $this->translations[$key]['forceTranslation'] = true;
                }
            }
        }
    }

    /**
     * @param MissingTranslationEvent $event
     */
    public static function handleMissingTranslation(MissingTranslationEvent $event)
    {
        $cache = \Yii::$app->cache;
        $key = $event->category.$event->message.$event->language;
        $messages = $cache->get($key);

        if ($messages === false) {
            \Yii::info("@DB: No cache {$event->category}.{$event->message} FOR LANGUAGE {$event->language} @", static::class);

            $driver = \Yii::$app->getDb()->getDriverName();
            $caseInsensitivePrefix = $driver === 'mysql' ? 'binary' : '';
            $sourceMessage = SourceMessage::find()
                ->where('category = :category and message = '.$caseInsensitivePrefix.' :message', [
                    ':category' => $event->category,
                    ':message'  => $event->message,
                ])
                ->with('messages')
                ->one();

            if (!$sourceMessage) {
                \Yii::info("@WRITE TO DB: {$event->category}.{$event->message} FOR LANGUAGE {$event->language} @", static::class);

                $sourceMessage = new SourceMessage();
                $sourceMessage->setAttributes([
                    'category' => $event->category,
                    'message'  => $event->message,
                ], false);

                $sourceMessage->save(false);
            }
            /**
             * @var $message Message
             */
            //print_r($sourceMessage->messages);
            if ($sourceMessage->messages) {
                $messages = ArrayHelper::map($sourceMessage->messages, "language", "translation");
            } else {
                $messages = [];
            }

            $cache->set($key, $messages);
        }

        $message = ArrayHelper::getValue($messages, \Yii::$app->language);

        if ($message) {
            $event->translatedMessage = $message;
        }


    }
}
