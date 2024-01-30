<?php
    require('models/contactManager.php');

    // Si la page envoie l'option send, et que l'option est a true, on vérifie qu'on obtient des données.
    if (isset($_POST['send']) && $_POST['send'] == 1)
    {
        // ICI on vérifie que les données ne sont pas vide pour éviter d'envoyer un formulaire vide
        if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['comentary']))
        {
            ContactManager::sendMail();
        }
        else {
            header("location: index.php?page=contact&error=1&message=Tout les champs sont requis !");
            exit();
        }
    }

    ob_start(); 
?>

<section class="d-flex flex-column justify-content-center align-items-center h-100 w-100">
    <form class="d-flex flex-column align-items-center" method="POST" action="index.php?page=contact">
        <div>
            <input required type="text" name="lastname" placeholder="Nom">
        </div>
        <div>
            <input required type="text" name="firstname" placeholder="Prenom">
        </div>
        <div>
            <input required type="email" name="email" placeholder="Email">
        </div>
        <div>
            <textarea required name="comentary" rows="5" cols="33" placeholder="Votre commentaire..."></textarea>
        </div>
        <div>
            <button type="submit" name="send" value="1">Envoyer</button>
        </div>
    </form>

    <?php if (isset($_GET['error'])) { ?>
        <div class="d-flex justify-content-center mt-5">
            <p class="<?php echo $_GET['error'] == 0 ? "text-success fs-bold" : "text-danger fs-bold"?>"><?= $_GET['message'] ?></p>
        </div>
    <?php } ?>
</section>

<?php $content = ob_get_clean() ?>