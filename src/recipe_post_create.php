<?php
//STEP 1
//acceder aux variables de session -> user_id
session_start();

//STEP 2
//recuperer PDO via connect.php et mysql.php -> PDO
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/config/databaseconnect.php');

//STEP 3
// var_dump($_POST);
//vérifier que les données ne sont pas passées
//pour stopper l'utilisateur avec un
//empty() && !isset()
if(
    empty($_POST['title'])
    ||
    !isset($_POST['title'])
    ||
    empty($_POST['recipe'])
    ||
    !isset($_POST['recipe'])
){
    echo 'il faut un titre et une recette';
    return;
}


//STEP4
// tester l'insert dans phpmyadmin
//inséré avec sql -> prepare & execute les données dans la base de donnée
$sql = 'INSERT INTO recipes(title, recipe, user_id, is_enabled) VALUES (:title, :recipe, :user_id, :is_enabled)';
$request = $client->prepare($sql);
$request->execute([
    'title' => htmlspecialchars($_POST['title']),
    'recipe' => htmlspecialchars($_POST['recipe']),
    'user_id' => $_SESSION['user_id'],
    'is_enabled' => 1,
]);

//STEP5
//redirige l'user vers la page myslist.php
header("Location: ../mylist.php");
?>