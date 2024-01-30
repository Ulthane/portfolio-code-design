<?php
    // On initialise le manager pour les projets
    $projectManager = new ProjectManager();

    // On vérifie que la session est setter et qu'elle n'est pas vide,
    // sinon on redirige vers le login
    if (!isset($_SESSION['username']) || empty($_SESSION['username']))
    {
        header("location: index.php?page=login&error=1&message=Vous devez être connecté pour accéder à cette page.");
        exit();
    }

    // Fonction statique pour effacer les sessions
    LoginManager::getLogout();

    // On vérifie si on a passer des champs, si oui on envoie le formulaire
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['link']) && isset($_POST['tag']) && isset($_FILES['image']))
    {
        $projectManager->postProject($_POST);
    }

    // On vérifie qu'on a passer le paramètre delete ainsi qu'un id au format GET + POST
    if (isset($_GET['delete']) && $_GET['delete'] == 1)
    {
        $projectManager->deleteProject();
    }

    // Récupère tout les projets
    if ($_GET['category-adm'] === "pro_category")
    {
        $categoryAdm = "_projets";
        $projects = $projectManager->getProject();
    }

    // Section modifier, chargement du projet défini
    if (isset($_POST['selection']) && !empty($_POST['selection']))
    {
        $selectedProject = $projectManager->getProjectById();
    }

    if (isset($_GET['modify']))
    {
        if (isset($_POST['title']) && isset($_POST['tag']) && isset($_POST['link']) && isset($_POST['description']))
        {
            $projectManager->putProject();
        }
    }

    ob_start(); 
?>


<div class="h-100 d-flex section-central">
    <!-- Section qui affiche la navigation -->
    <?= $navigation ?>
    <section class="d-flex flex-column align-items-center h-100 w-100">

    <!-- ************************************* -->
    <!-- TRAITEMENT DE LA SECTION PRO_CAREGORY -->
    <!-- ************************************* -->

        <!-- Zone de navigation supérieure -->
        <?= $navigationType ?>

        <!-- Contenu de la page -->
        <div class="d-flex flex-column align-items-center justify-content-center h-75">

            <!-- SECTION ADD -->
            <?php if ($_GET['type'] === "add") { ?>
            <form class="d-flex flex-column align-items-center" action="index.php?page=admin&category-adm=pro_category&type=add" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="title">titre;</label>
                        <input id="title" type="text" name="title" placeholder="_mon-projet">
                    </div>
                    <div>
                        <label for="tag">tag;</label>
                        <input id="tag" type="text" name="tag" placeholder="react;javascript;css">
                    </div>
                    <div>
                        <label for="link">link;</label>
                        <input id="link" type="text" name="link" placeholder="https://mon-projet.fr">
                    </div>
                    <div>
                        <label for="description">description;</label>
                        <textarea id="description" rows="5" name="description" placeholder="Je décrit mon super projet..."></textarea>
                    </div>
                    <div>
                        <label for="image">image;</label>
                        <input id="image" type="file" name="image">
                    </div>
                    <button type="submit">envoyer</button>
            </form>


            <!-- SECTION MODIFY -->
            <?php } else if ($_GET['type'] === "modify") { ?>
                <form class="d-flex flex-column align-items-center" action="index.php?page=admin&category-adm=pro_category&type=modify" method="POST">
                    <select id="selection" name="selection">
                    <?php while ($res = $projects->fetch()) { ?>
                        <option value="<?= $res['id']; ?>"><?= $res['title']; ?></option>
                    <?php } ?>
                    </select>
                    <button class="d-block my-3" type="submit">charger</button>
                </form>

                <?php if (isset($_POST['selection']) && !empty($_POST['selection'])) { ?>
                <form class="d-flex flex-column align-items-center" action="<?php echo "index.php?page=admin&category-adm=pro_category&type=modify&modify=".$_POST['selection']  ?>"method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="title">titre;</label>
                        <input id="title" type="text" name="title" value="<?= $selectedProject['title'] ?>" placeholder="_mon-projet">
                    </div>
                    <div>
                        <label for="tag">tag;</label>
                        <input id="tag" type="text" name="tag" value="<?= $selectedProject['tag'] ?>" placeholder="Tag séparé par une virgule. Exemple : react,javascript,css">
                    </div>
                    <div>
                        <label for="link">link;</label>
                        <input id="link" type="text" name="link" value="<?= $selectedProject['link'] ?>" placeholder="https://mon-projet.fr">
                    </div>
                    <div>
                        <label for="description">description;</label>
                        <textarea id="description" rows="5" name="description" placeholder="Je décrit mon super projet..."><?= $selectedProject['description'] ?></textarea>
                    </div>
                    <button type="submit">modifier</button>
                </form>
                <?php } ?>


            <!-- SECTION DELETE -->
            <?php } else if ($_GET['type'] === "delete") { ?>
            <form class="d-flex flex-column align-items-center" method="POST" action="index.php?page=admin&category-adm=pro_category&type=delete&delete=1">
                <select id="choice" name="choice">
                    <?php while ($res = $projects->fetch()) { ?>
                        <option value="<?= $res['id']; ?>"><?= $res['title']; ?></option>
                    <?php } ?>
                </select>
                <button class="d-block my-3" type="submit">supprimer</button>
            </form>
            <?php } ?>
        </div>

        <!-- GESTION DES ERREURS -->
        <?php if (isset($_GET['error'])) { ?>
            <div class="d-flex justify-content-center mt-5">
                <p class="<?php echo $_GET['error'] == 0 ? "text-success fs-bold" : "text-danger fs-bold"?>"><?= $_GET['message'] ?></p>
            </div>
        <?php } ?>

    
    </section>
</div>

<?php $content = ob_get_clean() ?>