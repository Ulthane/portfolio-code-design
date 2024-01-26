<?php $projects = $projectManager->getProject(); ob_start(); ?>

<div class="h-100 d-flex section-central">
    <!-- Section qui affiche la navigation -->
    <?= $navigation ?>

    <section class="d-flex flex-column align-items-center h-100 w-100">
    <?php if ($_GET['category-adm'] === "pro_category") { ?>
            <!-- Zone de titre -->
            <div class="border-bottom-custom w-100 select-content">
                <div class="border-right-custom title d-flex justify-content-between">
                    projets;
                </div>
            </div>

            <!-- Contenu de la page -->
            <div class="mt-5 d-flex flex-column align-items-center">
                <h3 class="text-info m-4 border-top-custom border-bottom-custom p-2">_ajouter_</h3>

                <form class="d-flex flex-column align-items-center" action="index.php?page=admin&category-adm=pro_category" method="POST" enctype="multipart/form-data">

                    <div>
                        <label for="title">titre;</label>
                        <input id="title" type="text" name="title" placeholder="_mon-projet">
                    </div>

                    <div>
                        <label for="tag">tag;</label>
                        <input id="tag" type="text" name="tag" placeholder="Tag séparé par une virgule. Exemple : react,javascript,css">
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

                    <button type="submit">Envoyer</button>
                </form>
            </div>

            <div class="mt-5 d-flex flex-column align-items-center">
                <h3 class="text-primary m-4 border-top-custom border-bottom-custom p-2">_supprimer_</h3>
                
                <form class="m-3" method="POST" action="index.php?page=admin&category-adm=pro_category&delete=true">
                    <select id="choice" name="choice">
                        <?php while ($res = $projects->fetch()) { ?>
                            <option value="<?= $res['id']; ?>"><?= $res['title']; ?></option>
                        <?php } ?>
                    </select>
                    <button class="d-block my-3" type="submit">supprimer</button>
                </form>
            </div>

            <?php } else { ?> 
                <!-- Zone de titre -->
                <div class="border-bottom-custom w-100 select-content">
                <div class="border-right-custom title d-flex justify-content-between">
                    informations;
                </div>
            </div>

            <!-- Contenu de la page -->
            <div class="mt-5 d-flex flex-column align-items-center">
                <h3 class="text-info m-4 border-top-custom border-bottom-custom p-2">_ajouter_</h3>

                <form class="d-flex flex-column align-items-center" action="index.php?page=admin&category-adm=pro_category" method="POST" enctype="multipart/form-data">

                    <div>
                        <label for="title">titre;</label>
                        <input id="title" type="text" name="title" placeholder="_mon-projet">
                    </div>

                    <div>
                        <label for="tag">tag;</label>
                        <input id="tag" type="text" name="tag" placeholder="Tag séparé par une virgule. Exemple : react,javascript,css">
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

                    <button type="submit">Envoyer</button>
                </form>
            </div>

            <div class="mt-5 d-flex flex-column align-items-center">
                <h3 class="text-primary m-4 border-top-custom border-bottom-custom p-2">_supprimer_</h3>
                
                <form class="m-3" method="POST" action="index.php?page=admin&category-adm=pro_category&delete=true">
                    <select id="choice" name="choice">
                        <?php while ($res = $projects->fetch()) { ?>
                            <option value="<?= $res['id']; ?>"><?= $res['title']; ?></option>
                        <?php } ?>
                    </select>
                    <button class="d-block my-3" type="submit">supprimer</button>
                </form>
            </div>    
            <?php } ?>
            
            <?php if (isset($_GET['error'])) { ?>
                <div class="d-flex justify-content-center mt-5">
                    <p class="<?php echo $_GET['error'] == 0 ? "text-success fs-bold" : "text-danger fs-bold"?>"><?= $_GET['message'] ?></p>
                </div>
            </section>
    <?php } ?>
</div>

<?php $content = ob_get_clean() ?>