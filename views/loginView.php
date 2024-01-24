<?php ob_start() ?>

<section class="d-flex flex-column justify-content-center align-items-center h-100 w-100">
    <div>
        <?php 
            if (isset($_GET['error'])) {
                echo '<p class="text-danger">'.$_GET["message"].'</p>';
            } 
        ?>
    </div>
    <form class="d-flex flex-column align-items-center" method="POST" action="index.php?page=login">
        <div>
            <input required type="text" name="username" placeholder="Nom d'utilisateur">
        </div>
        <div>
            <input required type="password" name="password" placeholder="Mot de passe">
        </div>
        <div>
            <input type="submit" value="Connexion">
        </div>
    </form>
</section>

<?php $content = ob_get_clean() ?>