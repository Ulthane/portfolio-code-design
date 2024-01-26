<?php ob_start(); ?>

<div class="h-100 d-flex section-central">
    <!-- Section qui affiche la navigation -->
    <?= $navigation ?>

    <!-- Section qui affiche les centre d'interet -->
    <section class="border-right-custom m-0 sub-navigation">
        <div class="border-bottom-custom title d-flex">
            <p>info-personnelle</p>
        </div>
        <div class="mx-2 mt-3 d-flex flex-column">

            <?php while ($c = $category->fetch()) { ?>

                <!-- Section qui traite les catégorie -->
                <div class="d-flex align-items-center">
                    <div><i class="<?php echo (count($title[$c['name']]) > 0 ? "m-1 fa-solid fa-angle-down" : "m-1 fa-solid fa-angle-right") ?>"></i></div>
                    <img class="m-1 dir-icon" src="<?= '/public/assets/images/'.$c['color'].'-dir.png'; ?>" alt="icone de répertoire">
                    <div class="m-1"><?= $c['name']; ?></div>
                </div>

                <!-- Section qui traite les article -->
                <?php foreach($title[$c['name']] as $con) { ?>
                    <div class="d-flex align-items-center ms-4">
                        <img class="dir-icon mx-2" src="public/assets/images/markdown.png" alt="icone markdown">
                        <a class="<?php echo ($_GET['id'] == $con['id'] ? "text-light" : "text-light-blue") ?>" href=<?= 'index.php?page=about-me&category='.$_GET['category'].'&id='.$con['id'] ?>><?= $con['title'] ?></a>
                    </div>
                <?php }

            } ?>
            
        </div>

        <div class="mt-4 border-bottom-custom border-top-custom title d-flex">
            <p>contact</p>
        </div>
        <div class="mx-2 mt-3 d-flex align-items-center">
            <a class="text-light-blue" href="mailto:ulthane.dev@orange.fr"><i class="fa-solid fa-envelope mx-2"></i>ulthane.dev@orange.fr</a>
        </div>
    </section>

    <!-- Section qui affiche le contenu selectionné -->
    <section class="border-right-custom m-0 col select-content h-100">
        <!-- Zone de titre -->
        <div class="border-bottom-custom">
            <div class="border-right-custom title d-flex justify-content-between">
                <?= $content['title'] ?>
            </div>
        </div>

        <div class="content-section d-flex h-100">
            <!-- Section du contenu -->
            <div class="mx-4 my-4">
                <?= $content['content'] ?>
            </div>

            <!-- Scrollbar -->
            <div class="scrollbar h-100 border-left-custom">
                <div class="rectangle"></div>
            </div>
        </div>
    </section>

    <section class="m-0 col content-section d-flex flex-column justify-content-center align-items-center">
        <h5>Code Review</h5>
        <h3>Coming Soon</h3>
    </section>
</div>

<?php 
    $content = ob_get_clean();
?>