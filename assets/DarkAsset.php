<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Ассет для тёмной темы интерфейса
 *
 * Подключает CSS-файл с тёмной цветовой схемой.
 * Наследует базовые ассеты Yii2 и Bootstrap 5.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Assets
 * @package     app\assets
 */
class DarkAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/dark-theme.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}