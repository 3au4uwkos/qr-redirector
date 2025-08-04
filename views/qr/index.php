<?php

use yii\helpers\Html;

?>
<?php

/** @var yii\web\View $this */

$this->title = 'Генератор QR-кодов и коротких ссылок';
?>
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