<?php 
    $cat = $_GET['category'];

    $infoManager = new InfoManager();

    ob_start(); 
?>

<section class="d-flex flex-column align-items-center navigation">
    <div class="my-3"><a class="<?php echo ($cat === "pro_category" ? "navigation__active" : "text-light-blue");?>" href="<?php echo "index.php?page=about-me&category=pro_category&id=".$infoManager->getFirstId('pro_category') ?>"><i class="icon fa-solid fa-laptop-code"></i></a></div>
    <div class="my-3"><a class="<?php echo ($cat === "pi_category" ? "navigation__active" : "text-light-blue");?>" href="<?php echo "index.php?page=about-me&category=pi_category&id=".$infoManager->getFirstId('pi_category') ?>"><i class="icon fa-solid fa-lightbulb"></i></a></div>
    <div class="my-3"><a class="<?php echo ($cat === "hob_category" ? "navigation__active" : "text-light-blue");?>" href="<?php echo "index.php?page=about-me&category=hob_category&id=".$infoManager->getFirstId('hob_category') ?>"><i class="icon fa-solid fa-gamepad"></i></a></div>
</section>

<?php $navigation = ob_get_clean(); ?>