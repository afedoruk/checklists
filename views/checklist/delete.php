<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this 
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */
$this->title = 'Delete checklist';
$this->params['breadcrumbs'][] = ['label' => 'My lists', 'url' => ['checklist/my']];
$this->params['breadcrumbs'][] = ['label' => $list->title, 'url' => ['checklist/view', 'id'=>$list->id]];
$this->params['breadcrumbs'][] = 'Delete';
?>
<div class="checklist-delete">
    <h1><?= Html::encode($list->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'checklist-delete-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",            
        ],
    ]); ?>
	<div>Do you really want to delete this list? This action can not be undone.</div>
    <?= $form->field($model, 'id')->hiddenInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Delete', ['class' => 'btn btn-primary', 'name' => 'delete-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>    
</div>
