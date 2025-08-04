<?php
use yii\helpers\Html;
?>

<div class="alert alert-danger">
    <h5 class="alert-heading">Ошибка!</h5>
    <p><?= Html::encode($message) ?></p>
</div>

<button class="btn btn-primary btn-back w-100">
    <i class="bi bi-arrow-left"></i> Попробовать снова
</button>

<?php
$this->registerJs(<<<JS
$('.btn-back').on('click', function() {
    $.get('/qr/get-form', function(html) {
        $('#qr-container').html(html);
    });
});
JS);
?>