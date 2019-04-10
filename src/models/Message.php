<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 14.04.2016
 */
namespace skeeks\cms\i18nDb\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

class Message extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function getDb()
    {
        return \Yii::$app->get(\Yii::$app->i18n->db);
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public static function tableName()
    {
        $i18n = \Yii::$app->i18n;
        if (!isset($i18n->messageTable)) {
            throw new InvalidConfigException('You should configure i18n component');
        }
        return $i18n->messageTable;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['language', 'required'],
            ['language', 'string', 'max' => 16],
            ['translation', 'string'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('skeeks/i18nDb/app', 'ID'),
            'language' => \Yii::t('skeeks/i18nDb/app', 'Language'),
            'translation' => \Yii::t('skeeks/i18nDb/app', 'Translation')
        ];
    }
    public function getSourceMessage()
    {
        return $this->hasOne(SourceMessage::className(), ['id' => 'id']);
    }
}