<?php
// $loggedUser = false;

//step2
//verification des données du formulaire (email + password), avec un foreach dans l'array users
//$loggedUser = true;
try {
    $client = new PDO('mysql:host=localhost;dbname=05042024', 'root');
} catch (Exception $e) {
    // echo $e->getMessage();
    echo 'Il y a un problème avec la base de données';
}

$sql = 'SELECT * FROM users';
$request = $client->prepare($sql);
$request->execute();
$users = $request->fetchAll();


if (isset($_POST['email']) && isset($_POST['password'])) {
    foreach ($users as $user) {
        if (
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {
            $_SESSION['loggedUser'] = true;
            $_SESSION['full_name'] = $user['full_name'];
        }
    }
    if (!isset($_SESSION['loggedUser'])) {
        echo 'mauvais login/password';
    }
}

//step 1
//afficher un formulaire
?>

<?php if (!isset($_SESSION['loggedUser'])) : ?>
    <form action="index.php" method="POST">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>
        <button type="submit">Envoyer</button>
    </form>
<?php else : ?>
    <div>
        <p>Utilisateur Connecté</p>
        <p><?php echo $_SESSION['full_name']; ?></p>
        <a href="src/logout.php">Déconnexion</a>
    </div>
<?php endif; ?>