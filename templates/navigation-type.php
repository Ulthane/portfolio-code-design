<?php ob_start() ?>

    <div class="d-flex border-bottom-custom w-100 select-content">
        <div class="border-right-custom title d-flex justify-content-between">
            <?= $categoryAdm ?>
        </div>
        <div class="border-right-custom title d-flex justify-content-between">
            <a class="<?php echo $_GET['type'] === "add" ? "text-light" : "text-light-blue" ?>" href="<?php echo "index.php?page=admin&category-adm=".$cat."&type=add" ?>">_ajouter;</a>
        </div>
        <div class="border-right-custom title d-flex justify-content-between">
            <a class="<?php echo $_GET['type'] === "modify" ? "text-light" : "text-light-blue" ?>" href="<?php echo "index.php?page=admin&category-adm=".$cat."&type=modify" ?>">_modifier;</a>
        </div>
        <div class="border-right-custom title d-flex justify-content-between">
            <a class="<?php echo $_GET['type'] === "delete" ? "text-light" : "text-light-blue" ?>" href="<?php echo "index.php?page=admin&category-adm=".$cat."&type=delete" ?>">_supprimer;</a>
        </div>
    </div>

<?php $navigationType = ob_get_clean() ?>