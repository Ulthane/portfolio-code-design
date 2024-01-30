<?php
    // On initialise le manager pour les projets
    $projectManager = new ProjectManager();

    // Initialisation des variables
    $categoryArticle = null;

    // On vérifie que la session est setter et qu'elle n'est pas vide,
    // sinon on redirige vers le login
    if (!isset($_SESSION['username']) || empty($_SESSION['username']))
    {
        header("location: index.php?page=login&error=1&message=Vous devez être connecté pour accéder à cette page.");
        exit();
    }

    // Fonction statique pour effacer les sessions
    LoginManager::getLogout();

    /***** ADD *****/
    // On vérifie si le champ post selection à été ajouté, si oui on charge les catégories
    if (isset($_POST['selection']) && !empty($_POST['selection']))
    {
        $category = $projectManager->getCategory();
    }
    // Ajout de l'article en base
    if (isset($_GET['add']) && $_GET['add'] == 1)
    {
        $projectManager->postArticle(htmlspecialchars($_POST['selection']));
    }

    /***** MODIFY *****/
    if (isset($_POST['id-modify']) && !empty($_POST['id-modify']))
    {
        $selectedArticle = $projectManager->getArticleById();
    }

    if (isset($_GET['modify']) && !empty($_GET['modify']))
    {
        $projectManager->putArticle();
    }

    /***** DELETE *****/
    // On vérifie qu'on a passer le paramètre delete ainsi qu'un id au format GET + POST
    if (isset($_POST['selection-article']))
    {
        $deleteCategory = $projectManager->getArticle($_POST['selection-article']);
    } 
    else if (isset($_GET['selection']))
    {
        $deleteCategory = $projectManager->getArticle($_GET['selection']);
    }

    if (isset($_GET['delete']) && $_GET['delete'] == 1)
    {
        $projectManager->deleteArticle();
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
            <form class="d-flex flex-column align-items-center" action="index.php?page=admin&category-adm=pi_category&type=add" method="POST">
                <select id="selection" name="selection">
                    <option value="pi_category">_info.personnelle</option>
                    <option value="pro_category">_info.professionnelle</option>
                    <option value="hob_category">_info.hobbie</option>
                </select>
                <button class="d-block my-3" type="submit">charger</button>
            </form>

            <?php if (isset($_POST['selection']) && !empty($_POST['selection'])) { ?>
            <form class="d-flex flex-column align-items-center" action="<?php echo "index.php?page=admin&category-adm=pi_category&type=add&selection=".$_POST['selection']."&add=1" ?>" method="POST">
                <div>
                    <label for="selection-category">categorie;</label>
                    <select id="selection-category" name="selection-category">
                    <?php while ($res = $category->fetch()) { ?>
                        <option value="<?= $res['id'] ?>"><?= $res['name'] ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="title">titre;</label>
                    <input id="title" type="text" name="title" placeholder="_mon-parcours">
                </div>
                <div>
                    <label for="content">description;</label>
                    <textarea id="content" rows="5" name="content" placeholder="J'écrit le contenu de mon article..."></textarea>
                </div>
                <button class="d-block my-3" type="submit">Ajouter</button>
            </form>
            <?php } ?>


            <!-- SECTION MODIFY -->
            <?php } else if ($_GET['type'] === "modify") { ?>

                <form class="d-flex flex-column align-items-center" action="index.php?page=admin&category-adm=pi_category&type=modify" method="POST">
                    <select id="selection-article" name="selection-article">
                        <option value="pi_category">_info.personnelle</option>
                        <option value="pro_category">_info.professionnelle</option>
                        <option value="hob_category">_info.hobbie</option>
                    </select>
                    <button class="d-block my-3" type="submit">charger</button>
                </form>

                <?php if ((isset($_POST['selection-article']) && !empty($_POST['selection-article'])) || isset($_GET['selection'])) { ?>
                    <?php 
                        if (isset($_GET['selection']))
                        {
                            $link = $_GET['selection'];
                        } else {
                            $link = $_POST['selection-article'];
                        }
                    ?>
                <form class="d-flex flex-column align-items-center" action="<?= "index.php?page=admin&category-adm=pi_category&type=modify&selection=".$link ?>" method="POST">
                    <select id="id-modify" name="id-modify">
                    <?php while ($res = $deleteCategory->fetch()) { ?>
                        <option value="<?= $res['id'] ?>"><?= $res['title'] ?></option>
                    <?php } ?>
                    </select>
                    <button type="submit">charger</button>
                </form>
                <?php } ?>

                <?php if (isset($_POST['id-modify']) && !empty($_POST['id-modify'])) { ?>
                <form class="d-flex flex-column align-items-center" action="<?php echo "index.php?page=admin&category-adm=pi_category&type=modify&selection=".$_GET['selection']."&modify=".$_POST['id-modify']  ?>" method="POST">
                    <div>
                        <label for="title">titre;</label>
                        <input id="title" type="text" name="title" value="<?= $selectedArticle['title'] ?>" placeholder="_mon-projet">
                    </div>
                    <div>
                        <label for="description">description;</label>
                        <textarea id="description" rows="5" name="description" placeholder="Je décrit mon super projet..."><?= $selectedArticle['content'] ?></textarea>
                    </div>
                    <button type="submit">modifier</button>
                </form>
                <?php } ?>


            <!-- SECTION DELETE -->
            <?php } else if ($_GET['type'] === "delete") { ?>
            <form class="d-flex flex-column align-items-center" action="index.php?page=admin&category-adm=pi_category&type=delete" method="POST">
                <select id="selection-article" name="selection-article">
                    <option value="pi_category">_info.personnelle</option>
                    <option value="pro_category">_info.professionnelle</option>
                    <option value="hob_category">_info.hobbie</option>
                </select>
                <button class="d-block my-3" type="submit">charger</button>
            </form>

            <?php if (isset($_POST['selection-article']) && !empty($_POST['selection-article'])) { ?>
                <form class="d-flex flex-column align-items-center" action="<?php echo "index.php?page=admin&category-adm=pi_category&type=delete&selection=".$_POST['selection-article']."&delete=1" ?>" method="POST">
                    <select id="id-delete" name="id-delete">
                    <?php while ($res = $deleteCategory->fetch()) { ?>
                        <option value="<?= $res['id'] ?>"><?= $res['title'] ?></option>
                    <?php } ?>
                    </select>
                    <button type="submit">Supprimer</button>
                </form>
                <?php } ?>
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