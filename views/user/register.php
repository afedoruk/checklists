<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\RegisterForm $model
 */
 if($model->id)
 	$this->title = 'Update information';
 else
	$this->title = 'Registration';
 
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin([
        'id' => 'register-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'email') ?>
    <?php
    if($model->id)
	{
		echo "<p>Choose new password if you want to change old password:</p>";
	}
	?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_repeat')->passwordInput() ?>
  
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton($model->id?'update':'register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
  
</div>
