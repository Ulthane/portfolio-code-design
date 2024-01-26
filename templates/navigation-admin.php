<?php $cat = $_GET['category-adm']; ob_start(); ?>

<section class="d-flex flex-column align-items-center navigation">
    <div class="my-3"><a class="<?php echo ($cat === "pro_category" ? "navigation__active" : "text-light-blue");?>" href="index.php?page=admin&category-adm=pro_category"><i class="icon fa-solid fa-diagram-project"></i></a></div>
    <div class="my-3"><a class="<?php echo ($cat === "pi_category" ? "navigation__active" : "text-light-blue");?>" href="index.php?page=admin&category-adm=pi_category"><i class="icon fa-solid fa-info"></i></a></div>
</section>

<?php $navigation = ob_get_clean(); ?>