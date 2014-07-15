<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title=$list->title;
$this->params['breadcrumbs'][] = ['label' => 'My lists', 'url' => ['checklist/my']];
$this->params['breadcrumbs'][] = $this->title;

echo '<h2>'.$list->title.'</h2>';
if($list->isOwner())
{
	echo '<a href="'.\Yii::$app->urlManager->createUrl(['checklist/edit', 'id'=>$list->id]).'">Edit list</a> | ';
	echo '<a href="'.\Yii::$app->urlManager->createUrl(['checklist/delete', 'id'=>$list->id]).'">Delete list</a>';
}
if($list->isOwner() || !$list->private)
{
	echo ' <a href="'.\Yii::$app->urlManager->createUrl(['checklist/clone', 'id'=>$list->id]).'">Clone list</a>';
}
echo '<p>'.$list->description.'</p>';

$form = ActiveForm::begin([
        'id' => 'checklist-items-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{input}{error}",            
        ],
    ]); 
    

	if(sizeof($model->items)) {
		echo $form->field($model, 'status')->checkboxList($model->items);
	}

	if($list->isOwner()) {
		echo $form->field($model, 'id')->hiddenInput();
	?>
 <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
        </div>
    </div>
<?php
} 
ActiveForm::end();?>
