<?php $counter = 1; ob_start(); ?>

<div class="h-100 d-flex section-central">
    <!-- Section qui affiche les centre d'interet -->
    <section class="border-right-custom m-0">
        <div class="border-bottom-custom title-project d-flex">
            <p>projets</p>
        </div>
        <div class="mx-2 mt-3 d-flex flex-column">
            <ul class="filter">
                <li class="d-flex align-items-center my-2"><div class="filter__item"><i class="mx-3 icon fa-brands fa-codepen"></i></div> tout</li>
                <li class="d-flex align-items-center my-2"><div class="filter__item"><i class="mx-3 icon fa-brands fa-php"></i></div> php</li>
                <li class="d-flex align-items-center my-2"><div class="filter__item"><i class="mx-3 icon fa-brands fa-react"></i></div> react</li>
                <li class="d-flex align-items-center my-2"><div class="filter__item"><i class="mx-3 icon fa-brands fa-html5"></i></div> html</li>
                <li class="d-flex align-items-center my-2"><div class="filter__item"><i class="mx-3 icon fa-brands fa-css3-alt"></i></div> css</li>
                <li class="d-flex align-items-center my-2"><div class="filter__item"><i class="mx-3 icon fa-brands fa-js"></i></div> javascript</li>
                <li class="d-flex align-items-center my-2"><div class="filter__item"><i class="mx-3 icon fa-brands fa-python"></i></div> python</li>
            </ul>
        </div>
    </section>

    <!-- Section qui affiche le contenu selectionné -->
    <section class="border-right-custom m-0 col select-content h-100">
        <!-- Zone de titre -->
        <div class="border-bottom-custom">
            <div class="border-right-custom title d-flex justify-content-between">
                all;
            </div>
        </div>

        <div class="row">

            <!-- // Projet -->
            <?php while ($p = $projects->fetch()) { ?>

            <div class="d-flex align-items-center flex-column col-4 py-5">
                
                <div class="d-flex">
                    <h5 class="me-3 text-info project-card__title">Projet <?= $counter?></h5>
                    <p>// <?= $p['title'] ?></p>
                </div>

                <div class="project-card">
                    <div class="window position-relative">
                        <div class="window__icon">
                            <!-- <img src="<?= $p['image'] ?>" alt="icone langage"> -->
                        </div>
                        <img class="project-card__bg" src="<?= $p['image'] ?>" alt="image it">
                    </div>
                    <div class="p-4 border-top-custom">
                        <p><?= $p['description'] ?></p>
                        <a class="button" href="<?= $p['link'] ?>">Voir le projet</a>
                    </div>
                </div>

            </div>

            <?php $counter++; } ?>

        </div>
    </section>
</div>

<?php 
    $content = ob_get_clean();
    require('templates/base.php'); 
?>