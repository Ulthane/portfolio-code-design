<?php ob_start() ?>

<section class="d-flex flex-column align-items-center h-100 w-100">
    <!-- <nav class="navbar-">
        <ul class="d-flex">
            <li>1</li>
            <li>2</li>
            <li>3</li>
        </ul>
    </nav> -->
    <div class="row w-100 mt-10">
        <div class="col">
            <h5>_a-propos</h5>
            <form action="index.php" method="POST">
                <input type="hidden" name="page" value="admin">
                <input type="hidden" name="page" value="admin">
                <input type="hidden" name="page" value="admin">

                <button type="submit">Envoyer</button>
            </form>
        </div>
        <div class="col">
            <h5>_projets</h5>
        </div>
    </div>
    <div class="row">

    </div>
</section>

<?php $content = ob_get_clean() ?>