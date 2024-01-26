<?php ob_start() ?>

<section class="d-flex flex-column justify-content-center align-items-center h-100 w-100">
    <form class="d-flex flex-column align-items-center" method="POST" action="index.php">
        <div>
            <input type="hidden" name="page" value="contact">
        </div>
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
            <button type="submit" name="logout" value="1">Envoyer</button>
        </div>
    </form>
</section>

<?php $content = ob_get_clean() ?>