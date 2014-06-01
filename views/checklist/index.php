<?php
use yii\helpers\Html;

$this->title='My checklists';
$this->params['breadcrumbs'][] = $this->title;

if(sizeof($lists)) {
?>
	<ul>
		<?php foreach($lists as $list){
			echo '<li><a href="'.\Yii::$app->urlManager->createUrl(['checklist/view', 'id'=>$list->id]).'">'.$list->title.'</a></li>';
		}
		?>
	</ul>
<?
}?>

<a href='<?php echo \Yii::$app->urlManager->createUrl('checklist/create');?>'>Create new list</a>
