<?php
require __DIR__ . '/vendor/autoload.php';

use App\Text;

$imageName = $_GET['image'] ?? 'larajobs1';
$startY = $_GET['start'] ?? 250;
$step = $_GET['step'] ?? 50;
$debug = $_GET['debug'] ?? false;
$size = (int)$_GET['size'];


$vacancy = $_GET['vacancy'] ?? '';
$salary = $_GET['salary'] ?? '';
$town = $_GET['town'] ?? '';
$exp = $_GET['exp'] ?? '';

/** @var Text\BaseAbstract[] $texts */
$texts = [
    new Text\Vacancy($vacancy),
    new Text\Salary($salary),
    new Text\Town($town),
    new Text\Experience($exp)
];


if (!$debug) {
    header('Content-type: image/jpeg');
}
$jpg_image = imagecreatefromjpeg(App\DataHelper::getImage($imageName));

foreach ($texts as $item) {
    $item->setImage($jpg_image);
    $item->setY($startY);
    $item->setSize($size);
    $startY += $step;
    $item->write();
}

imagejpeg($jpg_image);
imagedestroy($jpg_image);
