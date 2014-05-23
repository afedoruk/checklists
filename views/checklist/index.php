<?php if(sizeof($lists)) {
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
