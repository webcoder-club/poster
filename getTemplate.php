<?php
require __DIR__ . '/vendor/autoload.php';

$id = (int)$_GET['id'];
$imageName = $_GET['image'] ?? 'larajobs1';
$parseHH = new App\ParseHH($id);

echo json_encode([
    'id' => $id,
    'texts' => $parseHH->getTexts()
]);