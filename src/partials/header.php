<header>
    <nav id="menu">
        <h3>Titre menu</h3>
        <ul>
            <li><a class="active" aria-current="page" href="index.php">Home</a></li>
            <li><a class="nav-link" href="contact.php">Contact</a></li>
            <?php if (isset($_SESSION['loggedUser'])) : ?>
                <li><a class="nav-link" href="mylist.php">Ma liste de recettes</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>