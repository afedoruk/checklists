<?php
use yii\helpers\Html;

$this->title=$category->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<ul>
<?php
foreach($category->public as $list) {
	echo '<li><a href="'.\Yii::$app->urlManager->createUrl(['checklist/view', 'id'=>$list->id]).'">'.$list->title.'</a></li>';
}
?>
</ul>