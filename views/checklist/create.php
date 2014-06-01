<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */
 
if($model->id)
	$this->title = 'Edit checklist';
else
	$this->title = 'Create new checklist';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checklist-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'checklist-create-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'description')->textarea() ?>
    <?= $form->field($model, 'rawItems')->textarea() ?>
    <?= $form->field($model, 'private')->checkbox() ?>
    <?  if($model->id) {
    		echo $form->field($model, 'id')->hiddenInput();
    }
	?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>    
</div>
