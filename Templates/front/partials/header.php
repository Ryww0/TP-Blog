<?php

use App\Service\Session;

?>

<header>
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= URL_ROOT ?>">Home</a>
        </div>
        <button type="button" class="btn btn-primary">Connexion</button>
        <button type="button" class="btn btn-success">Inscription</button>
    </nav>
    <?php Session::showMessage(); ?>
</header>