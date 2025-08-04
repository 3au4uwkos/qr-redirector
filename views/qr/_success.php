<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

    <div class="qr-result text-center">
        <div class="qr-code mb-4">
            <img src="<?= $qrCode ?>" class="img-fluid" alt="QR Code">
        </div>

        <div class="input-group mb-4">
            <input
                    type="text"
                    class="form-control"
                    value="<?= Yii::$app->request->hostInfo . '/' . $shortUrl ?>"
                    readonly
                    id="short-url-input"
            >
            <button class="btn btn-outline-secondary" type="button" id="copy-btn">
                <i class="bi bi-clipboard"></i>
            </button>
        </div>

        <div class="mb-4">
            <a href="<?= Url::to(['/redirect/index', 'code' => $shortUrl]) ?>"
               class="btn btn-primary"
               target="_blank">
                Перейти по ссылке
            </a>
        </div>

        <button class="btn btn-outline-primary btn-back">
            <i class="bi bi-arrow-left"></i> Создать новую
        </button>
    </div>

<?php
$this->registerJs(<<<JS
$('#copy-btn').on('click', function() {
    let input = document.getElementById('short-url-input');
    input.select();
    document.execCommand('copy');
    
    let icon = $(this).find('i');
    icon.removeClass('bi-clipboard').addClass('bi-check');
    
    setTimeout(function() {
        icon.removeClass('bi-check').addClass('bi-clipboard');
    }, 2000);
});

$('.btn-back').on('click', function() {
    $.get('/qr/get-form', function(html) {
        $('#qr-container').html(html);
    });
});
JS);
?>