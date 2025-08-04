<?php
use yii\helpers\Html;

$this->title = 'Ошибка перехода';
?>
<div class="site-error">
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
</div>