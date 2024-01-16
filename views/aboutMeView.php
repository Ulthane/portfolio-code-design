<?php 
    require('templates/navigation.php');
    ob_start(); 
?>

<div class="h-90 d-flex">
    <?= $navigation ?>

    <section class="border-right-custom m-0 sub-navigation">
        <div class="border-bottom-custom title d-flex">
            <p>info-personnelle</p>
        </div>
    </section>
</div>

<?php 
    $content = ob_get_clean();
     require('templates/base.php'); 
?>