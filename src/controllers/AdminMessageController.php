<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 14.04.2016
 */

namespace skeeks\cms\i18nDb\controllers;
use skeeks\cms\helpers\RequestResponse;
use skeeks\cms\i18nDb\I18NDbComponent;
use skeeks\cms\i18nDb\models\search\SourceMessageSearch;
use skeeks\cms\i18nDb\models\SourceMessage;
use skeeks\cms\modules\admin\controllers\AdminModelEditorController;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class AdminMessageController
 * @package skeeks\cms\i18nDb\controllers
 */
class AdminMessageController extends AdminModelEditorController
{
    public function init()
    {
        $this->name                    = \Yii::t('skeeks/i18nDb/app', 'Database of translations');
        $this->modelShowAttribute      = "message";
        $this->modelClassName          = SourceMessage::className();

        parent::init();
    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = ArrayHelper::merge(parent::actions(),
            [
                'index' =>
                [
                    'modelSearchClassName' => SourceMessageSearch::className(),
                ],
                
                "update" =>
                [
                    'callback' => [$this, 'update']
                ],

            ]
        );

        if (!\Yii::$app->i18n instanceof I18NDbComponent)
        {
            $actions['index'] =
            [
                'class'     => AdminAction::className(),
                'name'      => \Yii::t('skeeks/i18nDb/app', 'Database of translations'),
                'callback'  => [$this, 'index']
            ];

            unset($actions['update']);
        }

        unset($actions['create']);

        return $actions;
    }

    public function index(AdminAction $adminAction)
    {
        return $this->render('index-configurate');
    }

    public function update()
    {

        /**
         * @var $model SourceMessage
         */
        $model          = $this->model;
        $model->initMessages();

        $rr = new RequestResponse();

        if (\Yii::$app->request->isAjax && !\Yii::$app->request->isPjax)
        {
            Model::loadMultiple($model->messages, \Yii::$app->getRequest()->post());
            return Model::validateMultiple($model->messages);

            //return $rr->ajaxValidateForm($model);
        }

        if ($rr->isRequestPjaxPost())
        {
            if (Model::loadMultiple($model->messages, \Yii::$app->getRequest()->post()) && Model::validateMultiple($model->messages))
            {
                $model->saveMessages();
                \Yii::$app->getSession()->setFlash('success', \Yii::t('app','Saved'));

                if (\Yii::$app->request->post('submit-btn') == 'apply')
                {

                } else
                {
                    return $this->redirect(
                        $this->indexUrl
                    );
                }

            } else
            {
                \Yii::$app->getSession()->setFlash('error', \Yii::t('app','Could not save'));
            }


        }

        return $this->render('_form', [
            'model' => $model
        ]);
    }
}
