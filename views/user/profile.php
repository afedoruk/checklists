<?
use yii\helpers\Html;

$this->title=$user->username;
?>
<h1><?= Html::encode($this->title) ?></h1>
<ul>
<?php
echo '<li><a href="'.\Yii::$app->urlManager->createUrl(['checklist/my']).'">My checklists</a></li>';
echo '<li><a href="'.\Yii::$app->urlManager->createUrl(['user/settings']).'">Change settings</a></li>';
?>
</ul>