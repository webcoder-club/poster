<?php
require __DIR__ . '/vendor/autoload.php';

$id = (int)$_GET['id'];
$imageName = $_GET['image'] ?? 'larajobs1';
$startY = $_GET['start'] ?? 250;
$step = $_GET['step'] ?? 50;
$debug = $_GET['debug'] ?? false;
$size = (int)$_GET['size'];

$parseHH = new App\ParseHH($id);


if (!$debug) {
    header('Content-type: image/jpeg');
}
$jpg_image = imagecreatefromjpeg(App\DataHelper::getImage($imageName));

foreach ($parseHH->execute() as $item) {
    $item->setImage($jpg_image);
    $item->setY($startY);
    $item->setSize($size);
    $startY += $step;
    $item->write();
}

imagejpeg($jpg_image);
imagedestroy($jpg_image);
