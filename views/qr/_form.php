<?php
/**
 * Partial view с формой для ввода URL
 *
 * Содержит форму с валидацией и обработкой через AJAX.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Views
 * @package     app\views\qr
 *
 * @var yii\web\View $this
 * @var app\models\UrlForm $model
 */
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\models\UrlForm;

$model = new UrlForm();
?>

<?php $form = ActiveForm::begin([
    'id' => 'qr-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'options' => [
        'class' => 'form-horizontal',
        'data-pjax' => true
    ],
    'fieldConfig' => [
        'template' => "{label}\n{input}\n{error}",
        'labelOptions' => ['class' => 'col-form-label'],
        'inputOptions' => ['class' => 'form-control'],
        'errorOptions' => ['class' => 'invalid-feedback']
    ]
]); ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title mb-4">Сократить ссылку</h2>

            <?= $form->field($model, 'url', [
                'inputTemplate' => '<div class="input-group">{input}<button class="btn btn-primary" type="submit">ОК</button></div>'
            ])->textInput([
                'placeholder' => 'https://example.com',
                'type' => 'url'
            ])->label(false) ?>

            <div class="form-text mb-3">
                Введите полный URL (с http:// или https://)
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>

<?php
$this->registerJs(<<<JS
$(document).off('submit', '#qr-form');
$(document).on('submit', '#qr-form', function(e) {
    e.preventDefault();
    let form = $(this);
    $.ajax({
        url: '/qr/generate',
        type: 'POST',
        data: form.serialize(),
        beforeSend: function() {
            form.find('button[type="submit"]')
                .prop('disabled', true)
                .html('<span class="spinner-border spinner-border-sm" role="status"></span>');
        },
        success: function(response) {
            console.log('Response:', response);
            $('#qr-container').html(response.html);
        },
        error: function() {
            $('#qr-container').html(
                '<div class="alert alert-danger">Ошибка соединения</div>'
            );
        },
        complete: function() {
            form.find('button[type="submit"]')
                .prop('disabled', false)
                .html('ОК');
        }
    });
});
JS
);
?>