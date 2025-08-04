<?php

namespace app\components;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use yii\base\BaseObject;
use Yii;

/**
 * Генератор QR-кодов
 *
 * Использует библиотеку Endroid/QrCode для создания PNG-изображений QR-кодов.
 * Сохраняет сгенерированные коды в указанную директорию.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Components
 * @package     app\components
 */
class QrGenerator extends BaseObject
{
    /**
     * Генерирует QR-код для переданных данных
     *
     * @param string $data Данные для кодирования в QR-код
     * @return string Относительный путь к файлу QR-кода
     */
    public static function generate(string $data): string
    {
        $filename = Yii::$app->security->generateRandomString(32) . '.png';

        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($data)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->build();

        $fullPath = Yii::getAlias(Yii::$app->params['qrCodes']['storagePath']) . '/' . $filename;
        $result->saveToFile($fullPath);
        return Yii::getAlias(Yii::$app->params['qrCodes']['webPath']) . '/' . $filename;
    }
}