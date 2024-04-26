<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Mon site</title>
    <link href="css/style.css" rel="stylesheet" />
</head>

<body>

    <?php require_once(__DIR__ . '/src/partials/header.php'); ?>

    <div id="corps">
        <form method="POST" action="">
            <input type="text" name="search">
            <input type="submit" value="Rechercher">
        </form>
        <?php
        if (isset($_POST['search'])) {
            $url = "https://www.themealdb.com/api/json/v1/1/search.php?s=" . urlencode($_POST['search']);
            $data = file_get_contents($url);
            $recipes = json_decode($data, true);
            foreach ($recipes['meals'] as $recipe) {
                echo "<img class='image' height=100 src='" . $recipe['strMealThumb'] . "' />";
                echo "<h3>" . $recipe['strMeal'] . "</h3>";
                echo "<p>" . $recipe['strInstructions'] . "</p>";
                ?>
                <form method="POST" action="src/recipe_post_create.php">
                    <input type="hidden" name="title" value="<?php echo $recipe['strMeal']; ?>">
                    <input type="hidden" name="recipe" value="<?php echo $recipe['strInstructions']; ?>">
                    <input type="submit" value="LIKE">
                </form>
                <?php
            }
        }
        ?>
    </div>

    <?php require_once(__DIR__ . '/src/partials/footer.php'); ?>

</body>

</html>