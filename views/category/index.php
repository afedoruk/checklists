<ul>
<?php
foreach($categories as $category) {
	echo '<li><a href="'.\Yii::$app->urlManager->createUrl(['category/view', 'id'=>$category->id]).'">'.$category->title.'</a></li>';
}
?>
</ul>