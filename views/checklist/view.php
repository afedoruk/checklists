<?php
$this->title=$list->title;
$this->params['breadcrumbs'][] = ['label' => 'My lists', 'url' => ['checklist/my']];
$this->params['breadcrumbs'][] = $this->title;

echo '<h2>'.$list->title.'</h2>';
if($is_owner)
{
	echo '<a href="'.\Yii::$app->urlManager->createUrl(['checklist/edit', 'id'=>$list->id]).'">Edit list</a> | ';
	echo '<a href="'.\Yii::$app->urlManager->createUrl(['checklist/delete', 'id'=>$list->id]).'">Delete list</a>';
}
echo '<p>'.$list->description.'</p>';
echo '<ol>';
foreach($list->items as $item)
{
	echo '<li>'.$item->title.'</li>';
}
echo '</ol>';
