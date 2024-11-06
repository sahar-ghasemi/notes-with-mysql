<?php
$connection = require_once './Connection.php';

function generateRandomLightColor()
{
    return sprintf('#%02X%02X%02X', rand(200, 255), rand(200, 255), rand(200, 255));
}
$randomColor = generateRandomLightColor();

$note = [
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'color' => $randomColor,
];


if (empty($_POST['title'])) {
    header("Location: index.php?error=Title is required");
    exit();
}

$id = $_POST['id'] ?? null;
if ($id) {
    $connection->updateNote($id, $note);
} else {

    $connection->addNote($note);
}
header('Location: index.php');
exit();
