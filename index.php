<?php
$connection = require_once './Connection.php';

$notes = $connection->getNotes();

$currentNote = [
    'id' => '',
    'title' => '',
    'description' => '',
    'color' => ''
];
if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Document</title>
    <link rel="stylesheet" href="app.css">

</head>

<body>
    <div>

        <form class="new-note" method="post" action="save.php">
            <input type="hidden" name="id" value="<?php echo $currentNote['id']; ?>" />
            <input type="text" name="title" placeholder="Note Title" autocomplete="off"
                value="<?php echo $currentNote['title'] ?>">
            <?php if (isset($_GET['error'])): ?>
                <div class="error-message" style="color: red;">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?> <?php if (isset($_GET['titleError'])): ?>
                <div class="error" style="color: red;">
                    <?php echo htmlspecialchars($_GET['titleError']); ?>
                </div>
            <?php endif; ?>

            <textarea name="description" cols="30" rows="4" placeholder="Note Description"><?php echo $currentNote['description'] ?></textarea>
            <button type="submit">
                <?php if ($currentNote['id']): ?>
                    Update note<?php else: ?>
                    Create Note
                <?php endif; ?>
            </button>
        </form>

        <div class="notes">
            <?php foreach ($notes as $note): ?>

                <div class="note" style="background-color: <?php echo $note['color'] ?>;">
                    <div class="title">
                        <a href="?id=<?php echo $note['id'] ?>"><?php echo $note["title"] ?></a>
                    </div>
                    <div class="description">
                        <?php echo $note["description"] ?>
                    </div>
                    <small><?php echo $note["create_date"] ?></small>
                    <form method="post" action="delete.php">
                        <input type="hidden" name="id" value="<?php echo $note['id'] ?>" />
                        <button class="close" type="submit">X</button>
                    </form>
                </div>

            <?php endforeach; ?>
        </div>
</body>

</html>