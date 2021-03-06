<?php

use yii\helpers\Html;
use skeeks\cms\modules\admin\widgets\form\ActiveFormUseTab as ActiveForm;

/* @var $this yii\web\View */
/* @var $model \skeeks\cms\i18nDb\models\SourceMessage */
?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message')->textarea([
        'rows' => 3,
        'disabled' => 'disabled'
    ]) ?>

    <div class="field">
        <div class="ui grid">
            <?php foreach (\Yii::$app->cms->languages as $language => $lang) : ?>
                <div class="four wide column">
                    <?= $form->field($model->messages[$language], '[' . $language . ']translation')->label($lang->name . " ({$lang->code})")->textarea([
                        'rows' => 3
                    ]); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?= $form->buttonsStandart($model); ?>

<?php ActiveForm::end(); ?>




