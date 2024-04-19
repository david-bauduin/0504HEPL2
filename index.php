<?php
session_start();
require_once(__DIR__ . '/src/config/mysql.php');
require_once(__DIR__ . '/src/config/databaseconnect.php');
require_once(__DIR__ . '/src/functions.php');

$sql = 'SELECT * FROM recipes WHERE is_enabled = TRUE';
$request = $client->prepare($sql);
$request->execute();
$recipes = $request->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Mon site</title>
    <link href="css/style.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="scripts/script.js"></script>
</head>

<body>
    <?php require_once(__DIR__ . '/src/partials/header.php'); ?>
    <div id="corps">
        <div class="login-page">
            <div class="form">
                <?php require_once(__DIR__ . '/src/register.php'); ?>
                <?php require_once(__DIR__ . '/src/login.php'); ?>
            </div>
        </div>
        <?php if (isset($_SESSION['loggedUser'])) : ?>
            <h1>Liste des recettes de cuisine</h1>

            <?php foreach ($recipes as $recipe) : ?>
                <article>
                    <h3><?php echo ($recipe['title']); ?></h3>
                    <div><?php echo ($recipe['recipe']); ?></div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php require_once(__DIR__ . '/src/partials/footer.php'); ?>

</body>

</html>