<?php
/**
 * Главная страница генератора QR-кодов
 *
 * Содержит контейнер для формы и результатов генерации.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Views
 * @package     app\views\qr
 *
 * @var yii\web\View $this
 */
use yii\helpers\Html;
?>

<?php $this->title = 'Генератор QR-кодов и коротких ссылок'; ?>

<div class="qr-index">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div id="qr-container">
                    <?= $this->render('_form') ?>
                </div>
            </div>
        </div>
    </div>
</div>